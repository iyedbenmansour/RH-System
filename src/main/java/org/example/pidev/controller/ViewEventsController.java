package org.example.pidev.controller;

import javafx.beans.property.ReadOnlyStringWrapper;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.HBox;
import javafx.scene.web.WebView;
import javafx.stage.Stage;
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

    private EventService eventService = new EventService();

    @FXML
    public void initialize() {
        // Set up table columns
        nameColumn.setCellValueFactory(new PropertyValueFactory<>("name"));
        descriptionColumn.setCellValueFactory(new PropertyValueFactory<>("description"));
        dateColumn.setCellValueFactory(new PropertyValueFactory<>("date"));
        locationColumn.setCellValueFactory(new PropertyValueFactory<>("location"));
        organiserColumn.setCellValueFactory(new PropertyValueFactory<>("organiser"));
        eventTypeColumn.setCellValueFactory(new PropertyValueFactory<>("eventType"));
        nbParticipantColumn.setCellValueFactory(new PropertyValueFactory<>("nbParticipant"));
        ticketPriceColumn.setCellValueFactory(new PropertyValueFactory<>("ticketPrice"));
        formationColumn.setCellValueFactory(cellData -> {
            Event event = cellData.getValue();
            return event.isHasFormation() && event.getFormation() != null ?
                    new ReadOnlyStringWrapper(event.getFormation().getTitre()) :
                    new ReadOnlyStringWrapper("No Formation");
        });

        // Set up actions column with buttons
        actionsColumn.setCellFactory(param -> new TableCell<>() {
            private final Button modifyButton = new Button("Modify");
            private final Button displayFormationButton = new Button("Display Formation");
            private final Button addFormationButton = new Button("Add Formation");
            private final Button seeMapButton = new Button("See Map Location");
            private final HBox buttonContainer = new HBox(5);

            {
                modifyButton.setStyle("-fx-background-color: #e61c1c; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");
                displayFormationButton.setStyle("-fx-background-color: #000000; -fx-text-fill: #ff0000; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");
                addFormationButton.setStyle("-fx-background-color: #ff0000; -fx-text-fill: #000000; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");
                seeMapButton.setStyle("-fx-background-color: #000000; -fx-text-fill: white; -fx-font-weight: bold; -fx-background-radius: 10; -fx-padding: 8 12;");

                // Modify button action
                modifyButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openModifyEventWindow(eventData);
                });

                // Display formation button action
                displayFormationButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openDisplayFormationWindow(eventData);
                });

                // Add formation button action
                addFormationButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openAddFormationWindow(eventData);
                });

                // See map location button action
                seeMapButton.setOnAction(event -> {
                    Event eventData = getTableView().getItems().get(getIndex());
                    openMapLocationInNewWindow(eventData);
                });

                // Add all buttons to button container
                buttonContainer.getChildren().addAll(modifyButton, displayFormationButton, addFormationButton, seeMapButton);
                buttonContainer.setSpacing(10);
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    Event eventData = getTableView().getItems().get(getIndex());

                    // Enable or disable buttons based on the presence of a formation
                    if (eventData.getFormation() == null) {
                        // If the event has no formation, enable "Add Formation" and disable "Display Formation"
                        addFormationButton.setDisable(false);
                        displayFormationButton.setDisable(true);
                    } else {
                        // If the event has a formation, disable "Add Formation" and enable "Display Formation"
                        addFormationButton.setDisable(true);
                        displayFormationButton.setDisable(false);
                    }

                    setGraphic(buttonContainer);
                }
            }
        });

        loadEvents();
    }

    // Load events into the TableView
    public void loadEvents() {
        if (eventService == null) {
            eventService = new EventService();
        }
        List<Event> events = eventService.getAllEvents();
        eventsTable.getItems().setAll(events);
    }

    // Open Modify Event window
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

    // Open Display Formation window
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

    // Open Add Formation window
    private void openAddFormationWindow(Event event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/add_formation.fxml"));
            Parent root = loader.load();

            AddFormationController controller = loader.getController();
            controller.setEvent(event);

            controller.setOnFormationAddedListener(this::refreshEventTable);

            Stage stage = new Stage();
            stage.setTitle("Add Formation");
            stage.setScene(new Scene(root));
            stage.show();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    // Refresh event table after formation is added
    private void refreshEventTable() {
        loadEvents();
        eventsTable.refresh();
    }

    // Open the map location for the selected event in a new window (using Google Maps)
    private void openMapLocationInNewWindow(Event event) {
        // Get the latitude and longitude of the selected event
        float latitude = event.getLatitude();
        float longitude = event.getLongitude();

        // Construct the URL for Google Maps with the latitude and longitude
        String mapUrl = "https://www.google.com/maps?q=" + latitude + "," + longitude;

        // Create a new stage (window) for the map
        Stage mapStage = new Stage();
        WebView mapWebView = new WebView(); // Create a new WebView for the map
        mapWebView.getEngine().load(mapUrl); // Load the Google Maps URL

        // Set the new stage and show the map
        mapStage.setTitle("Event Location");
        mapStage.setScene(new Scene(mapWebView, 800, 600)); // Set the size of the window
        mapStage.show();
    }

    // Show a simple alert
    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.show();
    }

    // Open the Search Event window
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

    // Set the EventService instance
    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }
}
