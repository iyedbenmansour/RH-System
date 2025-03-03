package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.Label;
import javafx.stage.Stage;
import org.example.pidev.model.Formation;
import org.example.pidev.service.FormationService;

import java.io.IOException;

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

    private Formation formation;
    private final FormationService formationService = new FormationService();
    private Stage stage;

    public void setFormation(Formation formation) {
        this.formation = formation;
        if (formation != null) {
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

    public void setStage(Stage stage) {
        this.stage = stage;
    }

    @FXML
    private void handleUpdateFormation() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/update_formation.fxml"));
            Parent root = loader.load();

            UpdateFormationController controller = loader.getController();
            controller.setFormation(formation);
            controller.setStage(stage);
            Stage updateStage = new Stage();
            updateStage.setScene(new Scene(root));
            updateStage.setTitle("Update Formation");
            updateStage.show();
        } catch (IOException e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "Could not open update window.");
        }
    }

    @FXML
    private void handleDeleteFormation() {
        try {
            Alert alert = new Alert(Alert.AlertType.CONFIRMATION);
            alert.setTitle("Delete Formation");
            alert.setHeaderText("Are you sure you want to delete this formation?");
            alert.setContentText("This action cannot be undone.");

            if (alert.showAndWait().get() == ButtonType.OK) {
                formationService.deleteFormation(formation.getId());

                showAlert(Alert.AlertType.INFORMATION, "Success", "Formation deleted successfully!");

                if (stage != null) {
                    stage.close();
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
            showAlert(Alert.AlertType.ERROR, "Error", "An error occurred while deleting the formation.");
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
