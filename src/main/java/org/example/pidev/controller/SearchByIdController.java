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
    private Stage stage;

    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }

    public void setStage(Stage stage) {
        this.stage = stage;
    }

    @FXML
    public void searchEventById() {
        try {
            int id = Integer.parseInt(idField.getText());
            Event event = eventService.getEventById(id);

            if (event != null) {
                nameLabel.setText(event.getName());
                descriptionLabel.setText(event.getDescription());
                dateLabel.setText(event.getDate().toString());
                locationLabel.setText(event.getLocation());
                organiserLabel.setText(event.getOrganiser());
                eventTypeLabel.setText(event.getEventType());
                nbParticipantLabel.setText(String.valueOf(event.getNbParticipant()));
                ticketPriceLabel.setText(String.valueOf(event.getTicketPrice()));

                eventDetailsBox.setVisible(true);
            } else {
                clearEventDetails();
                System.out.println("Event not found with ID: " + id);
            }
        } catch (NumberFormatException e) {
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