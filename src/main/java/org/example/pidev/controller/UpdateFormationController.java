package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import org.example.pidev.model.Formation;
import org.example.pidev.service.FormationService;

public class UpdateFormationController {

    private Formation formation;
    private Stage stage;

    @FXML
    private TextField titreField;
    @FXML
    private TextArea descriptionField;
    @FXML
    private TextField dureeField;
    @FXML
    private TextField prixField;
    @FXML
    private TextField typeField;
    @FXML
    private TextField formateurField;
    @FXML
    private TextField nbParticipantField;
    @FXML
    private Button updateButton;

    public void setFormation(Formation formation) {
        this.formation = formation;
        titreField.setText(formation.getTitre());
        descriptionField.setText(formation.getDescription());
        dureeField.setText(formation.getDuree());
        prixField.setText(String.valueOf(formation.getPrix()));
        typeField.setText(formation.getType());
        formateurField.setText(formation.getFormateur());
        nbParticipantField.setText(String.valueOf(formation.getNbParticipant()));
    }

    public void setStage(Stage stage) {
        this.stage = stage;
    }

    @FXML
    private void handleUpdateFormation() {
        try {
            // Validate input fields to make sure they are not empty
            if (titreField.getText().trim().isEmpty()) {
                showAlert(Alert.AlertType.ERROR, "Error", "Title cannot be empty.");
                return;
            }

            if (descriptionField.getText().trim().isEmpty()) {
                showAlert(Alert.AlertType.ERROR, "Error", "Description cannot be empty.");
                return;
            }
            formation.setTitre(titreField.getText().trim());
            formation.setDescription(descriptionField.getText().trim());
            formation.setDuree(dureeField.getText().trim());
            formation.setPrix(Float.parseFloat(prixField.getText().trim()));
            formation.setType(typeField.getText().trim());
            formation.setFormateur(formateurField.getText().trim());
            formation.setNbParticipant(Integer.parseInt(nbParticipantField.getText().trim()));

            FormationService formationService = new FormationService();
            formationService.updateFormation(formation);

            showAlert(Alert.AlertType.INFORMATION, "Success", "Formation updated successfully!");

            if (stage != null) {
                stage.close();
            }

        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "An unexpected error occurred while updating the formation.");
        }
    }

    private void showAlert(Alert.AlertType alertType, String title, String message) {
        Alert alert = new Alert(alertType);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.show();
    }
}
