package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.stage.Stage;
import javafx.util.Callback;
import javafx.beans.property.ReadOnlyStringWrapper;
import javafx.scene.layout.HBox;
import org.example.pidev.model.Event;
import org.example.pidev.service.EventService;

import java.util.List;

public class ViewEventsController {

    @FXML
    private TableView<Event> eventsTable;

    @FXML
    private TableColumn<Event, String> nameColumn;

    @FXML
    private TableColumn<Event, String> descriptionColumn;

    @FXML
    private TableColumn<Event, String> dateColumn;

    @FXML
    private TableColumn<Event, String> locationColumn;

    @FXML
    private TableColumn<Event, String> organiserColumn;

    @FXML
    private TableColumn<Event, String> eventTypeColumn;

    @FXML
    private TableColumn<Event, Integer> nbParticipantColumn;

    @FXML
    private TableColumn<Event, Float> ticketPriceColumn;

    @FXML
    private TableColumn<Event, String> formationColumn;

    @FXML
    private TableColumn<Event, Void> actionsColumn;

    private EventService eventService = new EventService(); // Ensure eventService is initialized

    @FXML
    public void initialize() {
        // Bind TableView columns to Event properties
        nameColumn.setCellValueFactory(new PropertyValueFactory<>("name"));
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("date"));
        locationColumn.setCellValueFactory(new PropertyValueFactory<>("location"));
        organiserColumn.setCellValueFactory(new PropertyValueFactory<>("organiser"));
        eventTypeColumn.setCellValueFactory(new PropertyValueFactory<>("eventType"));
        nbParticipantColumn.setCellValueFactory(new PropertyValueFactory<>("nbParticipant"));
        ticketPriceColumn.setCellValueFactory(new PropertyValueFactory<>("ticketPrice"));

        // Bind Formation column
        formationColumn.setCellValueFactory(cellData -> {
            Event event = cellData.getValue();
            return event.isHasFormation() && event.getFormation() != null ?
                    new ReadOnlyStringWrapper(event.getFormation().getTitre()) :
                    new ReadOnlyStringWrapper("No Formation");
        });

        // Add "Modify" and "Display/Add Formation" buttons
        actionsColumn.setCellFactory(param -> new TableCell<>() {
            private final Button modifyButton = new Button("Modify");
            private final Button displayFormationButton = new Button("Display Formation");
            private final Button addFormationButton = new Button("Add Formation");
            private final HBox buttonContainer = new HBox(5); // Set spacing between buttons

            {
                // Style buttons
                modifyButton.setStyle("-fx-background-color: #2c3e50; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");
                displayFormationButton.setStyle("-fx-background-color: #27ae60; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");
                addFormationButton.setStyle("-fx-background-color: #e67e22; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");

                // Set button actions
                modifyButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openModifyEventWindow(eventData);
                });

                displayFormationButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openDisplayFormationWindow(eventData);
                });

                addFormationButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openAddFormationWindow(eventData);
                });

                // Add buttons to HBox
                buttonContainer.getChildren().addAll(modifyButton, displayFormationButton, addFormationButton);
                buttonContainer.setSpacing(10); // Adjust spacing
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    Event eventData = getTableView().getItems().get(getIndex());

                    // Enable/Disable buttons dynamically
                    if (eventData.getFormation() == null) {
                        addFormationButton.setDisable(false);
                        displayFormationButton.setDisable(true);
                    } else {
                        addFormationButton.setDisable(true);
                        displayFormationButton.setDisable(false);
                    }

                    setGraphic(buttonContainer);
                }
            }
        });

        // Load events into the table
        loadEvents();
    }

    public void loadEvents() {
        if (eventService == null) {
            eventService = new EventService(); // Ensure eventService is initialized
        }
        List<Event> events = eventService.getAllEvents();
        eventsTable.getItems().setAll(events);
    }

    private void openModifyEventWindow(Event event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/modify_event.fxml"));
            Parent root = loader.load();

            ModifyEventController controller = loader.getController();
            controller.setEventService(eventService);
            controller.setEvent(event);

            Stage stage = new Stage();
            stage.setTitle("Modify Event");
            stage.setScene(new Scene(root));
            controller.setStage(stage);
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void openDisplayFormationWindow(Event event) {
        if (event.getFormation() == null) {
            showAlert("No Formation", "This event has no formation linked.");
            return;
        }

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/display_formation.fxml"));
            Parent root = loader.load();

            DisplayFormationController controller = loader.getController();
            controller.setFormation(event.getFormation());

            Stage stage = new Stage();
            stage.setTitle("Formation Details");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @FXML
    public void openSearchEventWindow() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/search_event.fxml"));
            Parent root = loader.load();

            SearchEventController controller = loader.getController();
            controller.setEventService(eventService);

            Stage stage = new Stage();
            stage.setTitle("Search Event");
            stage.setScene(new Scene(root));
            controller.setStage(stage);
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.show();
    }

    private void openAddFormationWindow(Event event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/add_formation.fxml"));
            Parent root = loader.load();

            AddFormationController controller = loader.getController();
            controller.setEvent(event); // Pass event data to the form

            // ✅ Set listener to update event table after adding a formation
            controller.setOnFormationAddedListener(this::refreshEventTable);

            Stage stage = new Stage();
            stage.setTitle("Add Formation");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // ✅ Refreshes the Table after adding a formation
    private void refreshEventTable() {
        loadEvents();
        eventsTable.refresh();
    }

    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }
}
