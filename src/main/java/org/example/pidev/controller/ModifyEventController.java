package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Modality;
import javafx.stage.Stage;
import org.example.pidev.model.Event;
import org.example.pidev.model.Formation;
import org.example.pidev.service.EventService;
import org.example.pidev.service.FormationService;

import java.io.IOException;
import java.util.List;

public class ModifyEventController {

    @FXML
    private TextField nameField;
    @FXML
    private TextField descriptionField;
    @FXML
    private DatePicker datePicker;
    @FXML
    private TextField locationField;
    @FXML
    private TextField organiserField;
    @FXML
    private TextField eventTypeField;
    @FXML
    private TextField nbParticipantField;
    @FXML
    private TextField ticketPriceField;
    @FXML
    private CheckBox hasFormationCheckBox;
    @FXML
    private ComboBox<Formation> formationComboBox;

    @FXML
    private TextField longitudeField;
    @FXML
    private TextField latitudeField;

    private EventService eventService;
    private FormationService formationService = new FormationService();
    private Event event;
    private Stage stage;

    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }

    public void setEvent(Event event) {
        this.event = event;
        populateFields();
    }

    public void setStage(Stage stage) {
        this.stage = stage;
    }

    private void populateFields() {
        nameField.setText(event.getName());
        descriptionField.setText(event.getDescription());
        datePicker.setValue(event.getDate());
        locationField.setText(event.getLocation());
        organiserField.setText(event.getOrganiser());
        eventTypeField.setText(event.getEventType());
        nbParticipantField.setText(String.valueOf(event.getNbParticipant()));
        ticketPriceField.setText(String.valueOf(event.getTicketPrice()));

        // Populate longitude and latitude fields
        longitudeField.setText(String.valueOf(event.getLongitude()));
        latitudeField.setText(String.valueOf(event.getLatitude()));

        hasFormationCheckBox.setSelected(event.isHasFormation());
        loadFormations();

        formationComboBox.setDisable(!event.isHasFormation());

        if (event.getFormation() != null) {
            formationComboBox.setValue(event.getFormation());
        }

        hasFormationCheckBox.selectedProperty().addListener((observable, oldValue, newValue) -> {
            formationComboBox.setDisable(!newValue);
        });
    }

    private void loadFormations() {
        List<Formation> formations = formationService.getAllFormations();
        formationComboBox.getItems().setAll(formations);
    }

    @FXML
    private void saveChanges() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/confirmation_dialog.fxml"));
            Parent root = loader.load();

            Stage dialogStage = new Stage();
            dialogStage.initModality(Modality.APPLICATION_MODAL);
            dialogStage.initOwner(stage);
            dialogStage.setScene(new Scene(root));
            dialogStage.setTitle("Confirm Updates");

            ConfirmationDialogController controller = loader.getController();
            controller.setMessage("Are you sure you want to save these changes?");
            controller.setButtonStyles("-fx-background-color: #4CAF50; -fx-text-fill: white; -fx-font-size: 14px;");
            controller.setCancelButtonStyles("-fx-background-color: #f44336; -fx-text-fill: white; -fx-font-size: 14px;");

            dialogStage.showAndWait();

            if (controller.isConfirmed()) {
                updateEventFromFields();
                eventService.updateEvent(event);
                stage.close();
                showSuccessAlert("Event updated successfully!");
            }
        } catch (IOException e) {
            showErrorAlert("Error loading confirmation dialog: " + e.getMessage());
        } catch (Exception e) {
            showErrorAlert("Failed to update event: " + e.getMessage());
        }
    }

    @FXML
    private void deleteEvent() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/confirmation_dialog.fxml"));
            Parent root = loader.load();

            Stage dialogStage = new Stage();
            dialogStage.initModality(Modality.APPLICATION_MODAL);
            dialogStage.initOwner(stage);
            dialogStage.setScene(new Scene(root));
            dialogStage.setTitle("Confirm Deletion");

            ConfirmationDialogController controller = loader.getController();
            controller.setMessage("Are you sure you want to delete this event?");
            controller.setButtonStyles("-fx-background-color: #f44336; -fx-text-fill: white; -fx-font-size: 14px;");
            controller.setCancelButtonStyles("-fx-background-color: #cccccc; -fx-text-fill: #333; -fx-font-size: 14px;");

            dialogStage.showAndWait();

            if (controller.isConfirmed()) {
                eventService.deleteEvent(event);
                stage.close();
                showSuccessAlert("Event deleted successfully!");
            }
        } catch (IOException e) {
            showErrorAlert("Error loading confirmation dialog: " + e.getMessage());
        } catch (Exception e) {
            showErrorAlert("Failed to delete event: " + e.getMessage());
        }
    }

    private void updateEventFromFields() {
        event.setName(nameField.getText());
        event.setDescription(descriptionField.getText());
        event.setDate(datePicker.getValue());
        event.setLocation(locationField.getText());
        event.setOrganiser(organiserField.getText());
        event.setEventType(eventTypeField.getText());
        event.setNbParticipant(Integer.parseInt(nbParticipantField.getText()));
        event.setTicketPrice(Float.parseFloat(ticketPriceField.getText()));

        // Get longitude and latitude from the fields
        try {
            event.setLongitude(Float.parseFloat(longitudeField.getText()));
            event.setLatitude(Float.parseFloat(latitudeField.getText()));
        } catch (NumberFormatException e) {
            showErrorAlert("Please enter valid numeric values for longitude and latitude.");
            return;
        }

        boolean hasFormation = hasFormationCheckBox.isSelected();
        Formation selectedFormation = hasFormation ? formationComboBox.getValue() : null;

        if (hasFormation && selectedFormation == null) {
            showErrorAlert("Please select a Formation if 'Has Formation' is checked.");
            return;
        }

        event.setHasFormation(hasFormation);
        event.setFormation(selectedFormation);
    }

    private void showSuccessAlert(String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle("Success");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.initOwner(stage);
        alert.show();
    }

    private void showErrorAlert(String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("Error");
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.initOwner(stage);
        alert.show();
    }
}
