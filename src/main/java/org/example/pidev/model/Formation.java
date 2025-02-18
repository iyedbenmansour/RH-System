package org.example.pidev.model;

public class Formation {
    private int id;
    private String titre;
    private String description;
    private String duree;
    private float prix;
    private String type;
    private String formateur;
    private int nbparticipant;
    private String status;
    private Event event; // ✅ Link to Event

    // 🔹 Constructors
    public Formation() {}

    public Formation(int id, String titre, String description, String duree, float prix, String type,
                     String formateur, int nbparticipant, String status) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.prix = prix;
        this.type = type;
        this.formateur = formateur;
        this.nbparticipant = nbparticipant;
        this.status = status;
        this.event = null; // Default to null if no event is provided
    }

    // ✅ Constructor With Event (If Needed)
    public Formation(int id, String titre, String description, String duree, float prix, String type,
                     String formateur, int nbparticipant, String status, Event event) {
        this.id = id;
        this.titre = titre;
        this.description = description;
        this.duree = duree;
        this.prix = prix;
        this.type = type;
        this.formateur = formateur;
        this.nbparticipant = nbparticipant;
        this.status = status;
        this.event = event;
    }

    // 🔹 Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getTitre() { return titre; }
    public void setTitre(String titre) { this.titre = titre; }

    public String getDescription() { return description; }
    public void setDescription(String description) { this.description = description; }

    public String getDuree() { return duree; }
    public void setDuree(String duree) { this.duree = duree; }

    public float getPrix() { return prix; }
    public void setPrix(float prix) { this.prix = prix; }

    public String getType() { return type; }
    public void setType(String type) { this.type = type; }

    public String getFormateur() { return formateur; }
    public void setFormateur(String formateur) { this.formateur = formateur; }

    public int getNbParticipant() { return nbparticipant; }
    public void setNbParticipant(int nbparticipant) { this.nbparticipant = nbparticipant; }

    public String getStatus() { return status; }
    public void setStatus(String status) { this.status = status; }

    // ✅ Getter & Setter for Event
    public Event getEvent() { return event; }
    public void setEvent(Event event) { this.event = event; }

// toString method for debugging
    @Override
    public String toString() {
        return "Formation{" +
                "id=" + id +
                ", titre='" + titre + '\'' +
                ", description='" + description + '\'' +
                ", duree='" + duree + '\'' +
                ", prix=" + prix +
                ", type='" + type + '\'' +
                ", formateur='" + formateur + '\'' +
                ", nbParticipant=" + nbparticipant +
                ", status='" + status + '\'' +
                '}';
    }
}
