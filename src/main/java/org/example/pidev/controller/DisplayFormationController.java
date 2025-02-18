package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Label;
import org.example.pidev.model.Formation;

public class DisplayFormationController {

    @FXML
    private Label titleLabel;
    @FXML
    private Label descriptionLabel;
    @FXML
    private Label durationLabel;
    @FXML
    private Label priceLabel;
    @FXML
    private Label typeLabel;
    @FXML
    private Label trainerLabel;
    @FXML
    private Label participantsLabel;
    @FXML
    private Label statusLabel;

    public void setFormation(Formation formation) {
        titleLabel.setText(formation.getTitre());
        descriptionLabel.setText(formation.getDescription());
        durationLabel.setText(formation.getDuree());
        priceLabel.setText(String.valueOf(formation.getPrix()));
        typeLabel.setText(formation.getType());
        trainerLabel.setText(formation.getFormateur());
        participantsLabel.setText(String.valueOf(formation.getNbParticipant()));
        statusLabel.setText(formation.getStatus());
    }
}
