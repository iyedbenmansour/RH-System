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
import javafx.util.StringConverter;
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
    private CheckBox hasFormationCheckBox;

    @FXML
    private ComboBox<Formation> formationComboBox;

    // New fields for longitude and latitude
    @FXML
    private TextField longitudeField;

    @FXML
    private TextField latitudeField;

    private EventService eventService = new EventService();
    private FormationService formationService = new FormationService();

    @FXML
    public void toggleFormationSelection() {
        if (hasFormationCheckBox != null && formationComboBox != null) {
            formationComboBox.setDisable(!hasFormationCheckBox.isSelected());
        }
    }

    @FXML
    public void initialize() {
        loadFormations();
        formationComboBox.setDisable(true);

        hasFormationCheckBox.selectedProperty().addListener((observable, oldValue, newValue) -> {
            formationComboBox.setDisable(!newValue);
        });

        // Customizing the ComboBox items display
        formationComboBox.setCellFactory(param -> new ListCell<Formation>() {
            @Override
            protected void updateItem(Formation item, boolean empty) {
                super.updateItem(item, empty);

                if (empty || item == null) {
                    setText(null);
                } else {
                    // Display the formation name, description, formateur, and price
                    setText(item.getTitre() + " - " + item.getDescription() + " - " + item.getFormateur() + " - $" + item.getPrix());
                }
            }
        });
    }

    private void loadFormations() {
        List<Formation> formations = formationService.getAllFormations();
        ObservableList<Formation> formationList = FXCollections.observableArrayList(formations);
        formationComboBox.setItems(formationList);
    }


    @FXML
    public void submitEvent() {
        try {
            String name = nameField.getText();
            String description = descriptionField.getText();
            LocalDate date = datePicker.getValue();
            String location = locationField.getText();
            String organiser = organiserField.getText();
            String eventType = eventTypeField.getText();
            int nbParticipant = Integer.parseInt(nbParticipantField.getText());
            float ticketPrice = Float.parseFloat(ticketPriceField.getText());

            // Get longitude and latitude
            float longitude = Float.parseFloat(longitudeField.getText());
            float latitude = Float.parseFloat(latitudeField.getText());

            boolean hasFormation = hasFormationCheckBox.isSelected();
            Formation selectedFormation = hasFormation ? formationComboBox.getValue() : null;

            if (hasFormation && selectedFormation == null) {
                showAlert("Error", "Please select a Formation if 'Has Formation' is checked.");
                return;
            }

            ScaleTransition scale = new ScaleTransition(Duration.millis(100), submitButton);
            scale.setToX(0.95);
            scale.setToY(0.95);
            scale.setAutoReverse(true);
            scale.setCycleCount(2);
            scale.play();

            int formationId = (selectedFormation != null) ? selectedFormation.getId() : 0;
            Event event = new Event(0, name, description, date, location, organiser, eventType, nbParticipant, ticketPrice, hasFormation, formationId, selectedFormation, longitude, latitude);

            eventService.addEvent(event);

            clearForm();

            showAlert("Success", "Event added successfully!");

        } catch (NumberFormatException e) {
            showAlert("Input Error", "Please enter valid numeric values for participants, ticket price, longitude, and latitude.");
        } catch (Exception e) {
            e.printStackTrace();
            showAlert("Error", "An error occurred while adding the event.");
        }
    }

    @FXML
    public void viewAllEvents() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/view_events.fxml"));
            Parent root = loader.load();

            ViewEventsController controller = loader.getController();
            controller.setEventService(eventService); // Pass the EventService to the controller
            controller.loadEvents(); // Load all events into the TableView

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
        longitudeField.clear();
        latitudeField.clear();
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
