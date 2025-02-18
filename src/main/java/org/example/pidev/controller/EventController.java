package org.example.pidev.controller;

import javafx.animation.ScaleTransition;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Stage;
import javafx.util.Duration;
import org.example.pidev.model.Event;
import org.example.pidev.model.Formation;
import org.example.pidev.service.EventService;
import org.example.pidev.service.FormationService;

import java.time.LocalDate;
import java.util.List;

public class EventController {
    @FXML
    private Button submitButton;

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
    private CheckBox hasFormationCheckBox; // Checkbox to enable/disable Formation selection

    @FXML
    private ComboBox<Formation> formationComboBox; // Dropdown for selecting Formation

    private EventService eventService = new EventService();
    private FormationService formationService = new FormationService(); // Fetch Formations

    @FXML
    public void toggleFormationSelection() {
        if (hasFormationCheckBox != null && formationComboBox != null) {
            formationComboBox.setDisable(!hasFormationCheckBox.isSelected());
        }
    }
    @FXML
    public void initialize() {
        loadFormations(); // Load Formation options
        formationComboBox.setDisable(true); // Initially disabled

        // Enable ComboBox only if checkbox is selected
        hasFormationCheckBox.selectedProperty().addListener((observable, oldValue, newValue) -> {
            formationComboBox.setDisable(!newValue);
        });
    }

    // Load all Formations into the ComboBox
    private void loadFormations() {
        List<Formation> formations = formationService.getAllFormations();
        ObservableList<Formation> formationList = FXCollections.observableArrayList(formations);
        formationComboBox.setItems(formationList);
    }

    @FXML
    public void submitEvent() {
        try {
            // Retrieve values from the form
            String name = nameField.getText();
            String description = descriptionField.getText();
            LocalDate date = datePicker.getValue();
            String location = locationField.getText();
            String organiser = organiserField.getText();
            String eventType = eventTypeField.getText();
            int nbParticipant = Integer.parseInt(nbParticipantField.getText());
            float ticketPrice = Float.parseFloat(ticketPriceField.getText());

            // Check if Formation is selected
            boolean hasFormation = hasFormationCheckBox.isSelected();
            Formation selectedFormation = hasFormation ? formationComboBox.getValue() : null;

            // Validate if a Formation is required but not selected
            if (hasFormation && selectedFormation == null) {
                showAlert("Error", "Please select a Formation if 'Has Formation' is checked.");
                return;
            }

            // Scale animation for submit button
            ScaleTransition scale = new ScaleTransition(Duration.millis(100), submitButton);
            scale.setToX(0.95);
            scale.setToY(0.95);
            scale.setAutoReverse(true);
            scale.setCycleCount(2);
            scale.play();

            // Create a new Event object
            int formationId = (selectedFormation != null) ? selectedFormation.getId() : 0;
            Event event = new Event(0, name, description, date, location, organiser, eventType, nbParticipant, ticketPrice, hasFormation, formationId, selectedFormation);


            // Add the event using the service
            eventService.addEvent(event);

            // Clear the form fields after submission
            clearForm();

            // Show success message
            showAlert("Success", "Event added successfully!");

        } catch (NumberFormatException e) {
            showAlert("Input Error", "Please enter valid numeric values for participants and ticket price.");
        } catch (Exception e) {
            e.printStackTrace();
            showAlert("Error", "An error occurred while adding the event.");
        }
    }

    @FXML
    public void viewAllEvents() {
        try {
            // Load the view_events.fxml file
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/view_events.fxml"));
            Parent root = loader.load();

            // Get the controller for the view_events.fxml
            ViewEventsController controller = loader.getController();
            controller.setEventService(eventService); // Pass the EventService to the controller
            controller.loadEvents(); // Load all events into the TableView

            // Create a new stage for the "View All Events" window
            Stage stage = new Stage();
            stage.setTitle("View All Events");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void clearForm() {
        nameField.clear();
        descriptionField.clear();
        datePicker.setValue(null);
        locationField.clear();
        organiserField.clear();
        eventTypeField.clear();
        nbParticipantField.clear();
        ticketPriceField.clear();
        hasFormationCheckBox.setSelected(false);
        formationComboBox.getSelectionModel().clearSelection();
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }


}
