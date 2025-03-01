package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import org.example.pidev.model.Event;
import org.example.pidev.model.Formation;
import org.example.pidev.service.EventService;

import java.util.List;

public class SearchEventController {

    @FXML
    private TextField idField;

    @FXML
    private TextField nameField;

    @FXML
    private VBox eventDetailsContainer;

    private EventService eventService;
    private Stage stage;

    public void setEventService(EventService eventService) {
        this.eventService = eventService;
    }

    public void setStage(Stage stage) {
        this.stage = stage;
    }

    @FXML
    public void searchEvent() {
        String idText = idField.getText();
        String name = nameField.getText();

        if (!idText.isEmpty()) {
            try {
                int id = Integer.parseInt(idText);
                Event event = eventService.getEventById(id);
                if (event != null) {
                    displayEventCards(List.of(event));
                    eventDetailsContainer.setVisible(true);
                } else {
                    eventDetailsContainer.setVisible(false);
                    System.out.println("Event not found with ID: " + id);
                }
            } catch (NumberFormatException e) {
                eventDetailsContainer.setVisible(false);
                System.err.println("Invalid ID format. Please enter a valid number.");
            }
        } else if (!name.isEmpty()) {
            List<Event> events = eventService.getEventsByName(name);
            if (!events.isEmpty()) {
                displayEventCards(events); // Display all matching events
                eventDetailsContainer.setVisible(true);
            } else {
                eventDetailsContainer.setVisible(false);
                System.out.println("No events found with name: " + name);
            }
        } else {
            eventDetailsContainer.setVisible(false);
            System.err.println("Please enter an ID or Name to search.");
        }
    }

    private void displayEventCards(List<Event> events) {
        eventDetailsContainer.getChildren().clear();

        for (Event event : events) {
            VBox eventCard = new VBox(10); // Increased spacing between elements
            eventCard.setStyle("-fx-background-color: rgb(0,0,0);"
                    + "-fx-border-color: rgb(0,0,0);"
                    + "-fx-border-radius: 15;"
                    + "-fx-padding: 15;"
                    + "-fx-effect: dropshadow(gaussian, rgba(0,0,0,0.2), 8, 0, 10, 5);");

            // Add event details to the card
            Label eventName = new Label("📅 Name: " + event.getName());
            eventName.setStyle("-fx-font-size: 18px; -fx-font-weight: bold; -fx-text-fill: white;");

            Label eventDescription = new Label("📝 Description: " + event.getDescription());
            eventDescription.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventDate = new Label("📅 Date: " + event.getDate());
            eventDate.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventLocation = new Label("📍 Location: " + event.getLocation());
            eventLocation.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventOrganiser = new Label("👤 Organiser: " + event.getOrganiser());
            eventOrganiser.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventType = new Label("🎭 Event Type: " + event.getEventType());
            eventType.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventParticipants = new Label("👥 Participants: " + event.getNbParticipant());
            eventParticipants.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            Label eventTicketPrice = new Label("💰 Ticket Price: " + event.getTicketPrice());
            eventTicketPrice.setStyle("-fx-font-size: 14px; -fx-text-fill: #f1f1f1;");

            // Add labels to the card
            eventCard.getChildren().addAll(eventName, eventDescription, eventDate, eventLocation, eventOrganiser, eventType, eventParticipants, eventTicketPrice);

            // If the event has a formation, add those details as well
            if (event.isHasFormation() && event.getFormation() != null) {
                Formation formation = event.getFormation();
                Label formationTitle = new Label("💡 Formation Attached:");
                formationTitle.setStyle("-fx-font-size: 14px; -fx-font-weight: bold; -fx-text-fill: #ffeb3b;");

                Label formationDetails = new Label(" - Title: " + formation.getTitre());
                formationDetails.setStyle("-fx-font-size: 13px; -fx-text-fill: #f1f1f1;");

                Label formationDescription = new Label(" - Description: " + formation.getDescription());
                formationDescription.setStyle("-fx-font-size: 13px; -fx-text-fill: #f1f1f1;");

                Label formationDuration = new Label(" - Duration: " + formation.getDuree());
                formationDuration.setStyle("-fx-font-size: 13px; -fx-text-fill: #f1f1f1;");

                Label formationPrice = new Label(" - Price: " + formation.getPrix());
                formationPrice.setStyle("-fx-font-size: 13px; -fx-text-fill: #f1f1f1;");

                Label formationTrainer = new Label(" - Trainer: " + formation.getFormateur());
                formationTrainer.setStyle("-fx-font-size: 13px; -fx-text-fill: #f1f1f1;");

                // Add formation details to the event card
                eventCard.getChildren().addAll(formationTitle, formationDetails, formationDescription, formationDuration, formationPrice, formationTrainer);
            } else {
                Label noFormation = new Label("📌 No Formation Linked");
                noFormation.setStyle("-fx-font-size: 14px; -fx-font-weight: bold; -fx-text-fill: #e74c3c;");
                eventCard.getChildren().add(noFormation);
            }

            // Add the event card to the main container
            eventDetailsContainer.getChildren().add(eventCard);
        }
    }

}
