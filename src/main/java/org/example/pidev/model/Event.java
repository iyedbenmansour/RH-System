package org.example.pidev.model;

import java.time.LocalDate;

public class Event {
    private int id;
    private String name;
    private String description;
    private LocalDate date;
    private String location;
    private String organiser;
    private String eventType;
    private int nbParticipant;
    private float ticketPrice;
    private boolean hasFormation;
    private int formationId; // Stores the formation ID
    private Formation formation; // Reference to Formation object

    // Default constructor
    public Event() {
    }

    // Constructor without Formation
    public Event(int id, String name, String description, LocalDate date, String location, String organiser, String eventType, int nbParticipant, float ticketPrice, boolean hasFormation) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.date = date;
        this.location = location;
        this.organiser = organiser;
        this.eventType = eventType;
        this.nbParticipant = nbParticipant;
        this.ticketPrice = ticketPrice;
        this.hasFormation = hasFormation;
        this.formationId = 0; // Default to no formation
        this.formation = null; // No formation by default
    }

    // Constructor with Formation
    public Event(int id, String name, String description, LocalDate date, String location, String organiser, String eventType, int nbParticipant, float ticketPrice, boolean hasFormation, int formationId, Formation formation) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.date = date;
        this.location = location;
        this.organiser = organiser;
        this.eventType = eventType;
        this.nbParticipant = nbParticipant;
        this.ticketPrice = ticketPrice;
        this.hasFormation = hasFormation;
        this.formationId = formationId;
        this.formation = formation;
    }

    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public LocalDate getDate() { return date; }
    public void setDate(LocalDate date) { this.date = date; }

    public String getLocation() { return location; }
    public void setLocation(String location) { this.location = location; }

    public String getOrganiser() { return organiser; }
    public void setOrganiser(String organiser) { this.organiser = organiser; }

    public String getEventType() { return eventType; }
    public void setEventType(String eventType) { this.eventType = eventType; }

    public int getNbParticipant() { return nbParticipant; }
    public void setNbParticipant(int nbParticipant) { this.nbParticipant = nbParticipant; }

    public float getTicketPrice() { return ticketPrice; }
    public void setTicketPrice(float ticketPrice) { this.ticketPrice = ticketPrice; }

    public boolean isHasFormation() { return hasFormation; }
    public void setHasFormation(boolean hasFormation) {
        this.hasFormation = hasFormation;
        if (!hasFormation) {
            this.formationId = 0;
            this.formation = null;
        }
    }

    public int getFormationId() { return formationId; }
    public void setFormationId(int formationId) {
        this.formationId = formationId;
        this.hasFormation = (formationId > 0); // Automatically set hasFormation to true if ID is valid
    }

    public Formation getFormation() { return formation; }
    public void setFormation(Formation formation) {
        this.formation = formation;
        if (formation != null) {
            this.formationId = formation.getId();
            this.hasFormation = true;
        }
    }

    // toString method for debugging
    @Override
    public String toString() {
        return "Event{" +
                "id=" + id +
                ", name='" + name + '\'' +
                ", description='" + description + '\'' +
                ", date=" + date +
                ", location='" + location + '\'' +
                ", organiser='" + organiser + '\'' +
                ", eventType='" + eventType + '\'' +
                ", nbParticipant=" + nbParticipant +
                ", ticketPrice=" + ticketPrice +
                ", hasFormation=" + hasFormation +
                ", formationId=" + (formationId > 0 ? formationId : "No Formation") +
                ", formation=" + (formation != null ? formation.getTitre() : "No Formation") +
                '}';
    }
}
