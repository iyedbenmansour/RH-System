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
    private VBox eventDetailsContainer; // Container for event cards

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
            // Search by ID
            try {
                int id = Integer.parseInt(idText);
                Event event = eventService.getEventById(id);
                if (event != null) {
                    displayEventCards(List.of(event)); // Display single event
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
            // Search by Name
            List<Event> events = eventService.getEventsByName(name);
            if (!events.isEmpty()) {
                displayEventCards(events); // Display all matching events
                eventDetailsContainer.setVisible(true);
            } else {
                eventDetailsContainer.setVisible(false);
                System.out.println("No events found with name: " + name);
            }
        } else {
            // No search criteria provided
            eventDetailsContainer.setVisible(false);
            System.err.println("Please enter an ID or Name to search.");
        }
    }

    private void displayEventCards(List<Event> events) {
        eventDetailsContainer.getChildren().clear(); // Clear previous results

        for (Event event : events) {
            // Create a card-like layout for each event
            VBox eventCard = new VBox(5);
            eventCard.setStyle("-fx-border-color: #ccc; -fx-border-radius: 5; -fx-padding: 10;");

            // Add event details to the card
            eventCard.getChildren().add(new Label("Name: " + event.getName()));
            eventCard.getChildren().add(new Label("Description: " + event.getDescription()));
            eventCard.getChildren().add(new Label("Date: " + event.getDate()));
            eventCard.getChildren().add(new Label("Location: " + event.getLocation()));
            eventCard.getChildren().add(new Label("Organiser: " + event.getOrganiser()));
            eventCard.getChildren().add(new Label("Event Type: " + event.getEventType()));
            eventCard.getChildren().add(new Label("Participants: " + event.getNbParticipant()));
            eventCard.getChildren().add(new Label("Ticket Price: " + event.getTicketPrice()));

            // If the event has a formation, display formation details
            if (event.isHasFormation() && event.getFormation() != null) {
                Formation formation = event.getFormation();
                eventCard.getChildren().add(new Label("💡 Formation Attached:"));
                eventCard.getChildren().add(new Label(" - Title: " + formation.getTitre()));
                eventCard.getChildren().add(new Label(" - Description: " + formation.getDescription()));
                eventCard.getChildren().add(new Label(" - Duration: " + formation.getDuree()));
                eventCard.getChildren().add(new Label(" - Price: " + formation.getPrix()));
                eventCard.getChildren().add(new Label(" - Trainer: " + formation.getFormateur()));
            } else {
                eventCard.getChildren().add(new Label("📌 No Formation Linked"));
            }

            // Add the card to the container
            eventDetailsContainer.getChildren().add(eventCard);
        }
    }
}
