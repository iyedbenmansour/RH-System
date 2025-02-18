package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import org.example.pidev.model.Event;
import org.example.pidev.service.EventService;

public class SearchByIdController {

    @FXML
    private TextField idField;

    @FXML
    private VBox eventDetailsBox;

    @FXML
    private Label nameLabel;

    @FXML
    private Label descriptionLabel;

    @FXML
    private Label dateLabel;

    @FXML
    private Label locationLabel;

    @FXML
    private Label organiserLabel;

    @FXML
    private Label eventTypeLabel;

    @FXML
    private Label nbParticipantLabel;

    @FXML
    private Label ticketPriceLabel;

    private EventService eventService;
    private Stage stage; // Add a Stage field

    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }

    // Add the setStage method
    public void setStage(Stage stage) {
        this.stage = stage;
    }

    @FXML
    public void searchEventById() {
        try {
            int id = Integer.parseInt(idField.getText()); // Get the ID from the text field
            Event event = eventService.getEventById(id); // Fetch the event by ID

            if (event != null) {
                // Populate the event details section
                nameLabel.setText(event.getName());
                descriptionLabel.setText(event.getDescription());
                dateLabel.setText(event.getDate().toString());
                locationLabel.setText(event.getLocation());
                organiserLabel.setText(event.getOrganiser());
                eventTypeLabel.setText(event.getEventType());
                nbParticipantLabel.setText(String.valueOf(event.getNbParticipant()));
                ticketPriceLabel.setText(String.valueOf(event.getTicketPrice()));

                // Make the event details section visible
                eventDetailsBox.setVisible(true);
            } else {
                // Clear the event details section and show a message
                clearEventDetails();
                System.out.println("Event not found with ID: " + id);
            }
        } catch (NumberFormatException e) {
            // Clear the event details section and show an error message
            clearEventDetails();
            System.err.println("Invalid ID format. Please enter a valid number.");
        }
    }

    private void clearEventDetails() {
        nameLabel.setText("");
        descriptionLabel.setText("");
        dateLabel.setText("");
        locationLabel.setText("");
        organiserLabel.setText("");
        eventTypeLabel.setText("");
        nbParticipantLabel.setText("");
        ticketPriceLabel.setText("");
        eventDetailsBox.setVisible(false);
    }
}