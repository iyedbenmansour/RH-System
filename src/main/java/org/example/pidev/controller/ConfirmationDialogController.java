package org.example.pidev.controller;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

public class ConfirmationDialogController {
    private boolean confirmed = false;

    @FXML
    private Label messageLabel;
    @FXML
    private Button confirmButton;
    @FXML
    private Button cancelButton;
    @FXML
    private VBox dialogContainer;

    @FXML
    private void handleConfirm() {
        confirmed = true;
        ((Stage) confirmButton.getScene().getWindow()).close();
    }

    @FXML
    private void handleCancel() {
        confirmed = false;
        ((Stage) confirmButton.getScene().getWindow()).close();
    }

    public boolean isConfirmed() {
        return confirmed;
    }

    public void setMessage(String message) {
        messageLabel.setText(message);
    }

    public void setButtonStyles(String style) {
        confirmButton.setStyle(style);
    }

    public void setCancelButtonStyles(String style) {
        cancelButton.setStyle(style);
    }

    public void setDialogStyle(String style) {
        dialogContainer.setStyle(style);
    }
}