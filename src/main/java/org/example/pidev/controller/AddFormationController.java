package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.stage.Stage;
import org.example.pidev.model.Formation;
import org.example.pidev.model.Event;
import org.example.pidev.service.FormationService;
import org.example.pidev.service.EventService;

public class AddFormationController {

    @FXML
    private TextField titreField;

    @FXML
    private TextArea descriptionField;

    @FXML
    private TextField dureeField;

    @FXML
    private TextField prixField;

    @FXML
    private TextField typeField;

    @FXML
    private TextField formateurField;

    @FXML
    private TextField nbParticipantField;

    @FXML
    private ComboBox<String> statusComboBox;

    @FXML
    private Button submitButton;

    private Event event; // The event linked to the formation
    private final FormationService formationService = new FormationService();
    private final EventService eventService = new EventService(); // Added to update event formation info
    private Stage stage; // Reference to the stage for closing
    private OnFormationAddedListener onFormationAddedListener; // Listener for refreshing the event table

    @FXML
    public void initialize() {
        // Populate ComboBox dynamically
        if (statusComboBox != null) {
            statusComboBox.getItems().addAll("Active", "Inactive", "Pending");
            statusComboBox.getSelectionModel().selectFirst(); // Default selection
        }
    }

    // Setter for event association
    public void setEvent(Event event) {
        this.event = event;
    }

    // Setter for stage reference (used for closing after submission)
    public void setStage(Stage stage) {
        this.stage = stage;
    }

    // Setter for event table refresh listener
    public void setOnFormationAddedListener(OnFormationAddedListener listener) {
        this.onFormationAddedListener = listener;
    }

    @FXML
    private void handleSubmitFormation() {
        try {
            // Validate input fields
            if (titreField.getText().trim().isEmpty() ||
                    descriptionField.getText().trim().isEmpty() ||
                    dureeField.getText().trim().isEmpty() ||
                    prixField.getText().trim().isEmpty() ||
                    typeField.getText().trim().isEmpty() ||
                    formateurField.getText().trim().isEmpty() ||
                    nbParticipantField.getText().trim().isEmpty() ||
                    (statusComboBox == null || statusComboBox.getValue() == null)) {

                showAlert(Alert.AlertType.ERROR, "Error", "Please fill in all fields before submitting.");
                return;
            }

            // Convert numeric values safely
            float prix;
            int nbParticipants;
            try {
                prix = Float.parseFloat(prixField.getText().trim());
                nbParticipants = Integer.parseInt(nbParticipantField.getText().trim());
            } catch (NumberFormatException e) {
                showAlert(Alert.AlertType.ERROR, "Error", "Invalid number format for Price or Number of Participants.");
                return;
            }

            // Create and populate new Formation object
            Formation newFormation = new Formation();
            newFormation.setTitre(titreField.getText().trim());
            newFormation.setDescription(descriptionField.getText().trim());
            newFormation.setDuree(dureeField.getText().trim());
            newFormation.setPrix(prix);
            newFormation.setType(typeField.getText().trim());
            newFormation.setFormateur(formateurField.getText().trim());
            newFormation.setNbParticipant(nbParticipants);
            newFormation.setStatus(statusComboBox.getValue());

            // Save formation and retrieve the new formation ID
            int formationId = formationService.addFormation(newFormation);
            if (formationId == -1) {
                showAlert(Alert.AlertType.ERROR, "Error", "Failed to add formation.");
                return;
            }

            // Update event with formation details
            if (event != null) {
                event.setHasFormation(true);
                event.setFormation(newFormation);

                // Ensure Event has a `setFormationId` method
                event.setFormationId(formationId);

                // Update event in the database
                eventService.updateEventFormation(event.getId(), formationId);
            }

            showAlert(Alert.AlertType.INFORMATION, "Success", "Formation added successfully!");

            // Refresh event table after adding a formation
            if (onFormationAddedListener != null) {
                onFormationAddedListener.onFormationAdded();
            }

            // Close the window after successful submission
            if (stage != null) {
                stage.close();
            }
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "An unexpected error occurred while adding the formation.");
        }
    }

    // Helper method to show alerts
    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.show();
    }

    // Interface for event table refresh after adding a formation
    public interface OnFormationAddedListener {
        void onFormationAdded();
    }
}
