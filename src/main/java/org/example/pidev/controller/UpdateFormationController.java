package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import org.example.pidev.model.Formation;
import org.example.pidev.service.FormationService;

public class UpdateFormationController {

    private Formation formation;  // The formation being updated
    private Stage stage;  // The stage used to close the window

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
    private Button updateButton;

    // Setter for passing the selected formation to this controller
    public void setFormation(Formation formation) {
        this.formation = formation;

        // Populate the fields with the existing formation details
        titreField.setText(formation.getTitre());
        descriptionField.setText(formation.getDescription());
        dureeField.setText(formation.getDuree());
        prixField.setText(String.valueOf(formation.getPrix()));
        typeField.setText(formation.getType());
        formateurField.setText(formation.getFormateur());
        nbParticipantField.setText(String.valueOf(formation.getNbParticipant()));
    }

    // Setter for the stage to close the window
    public void setStage(Stage stage) {
        this.stage = stage;
    }

    // Handle the update button click
    @FXML
    private void handleUpdateFormation() {
        try {
            // Validate input fields to make sure they are not empty
            if (titreField.getText().trim().isEmpty()) {
                showAlert(Alert.AlertType.ERROR, "Error", "Title cannot be empty.");
                return;
            }

            if (descriptionField.getText().trim().isEmpty()) {
                showAlert(Alert.AlertType.ERROR, "Error", "Description cannot be empty.");
                return;
            }

            // Update the formation object with new values from the form
            formation.setTitre(titreField.getText().trim());
            formation.setDescription(descriptionField.getText().trim());
            formation.setDuree(dureeField.getText().trim());
            formation.setPrix(Float.parseFloat(prixField.getText().trim()));
            formation.setType(typeField.getText().trim());
            formation.setFormateur(formateurField.getText().trim());
            formation.setNbParticipant(Integer.parseInt(nbParticipantField.getText().trim()));

            // Update the formation in the database
            FormationService formationService = new FormationService();
            formationService.updateFormation(formation);

            // Show success alert
            showAlert(Alert.AlertType.INFORMATION, "Success", "Formation updated successfully!");

            // Close the update window after successful update
            if (stage != null) {
                stage.close();
            }

        } catch (Exception e) {
            // Handle any unexpected errors
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "An unexpected error occurred while updating the formation.");
        }
    }

    // Helper method to show alert dialogs
    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.show();
    }
}
