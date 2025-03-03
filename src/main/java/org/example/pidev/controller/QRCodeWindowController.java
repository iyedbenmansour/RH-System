package org.example.pidev.controller;

import com.google.zxing.BarcodeFormat;
import com.google.zxing.EncodeHintType;
import com.google.zxing.MultiFormatWriter;
import com.google.zxing.common.BitMatrix;
import javafx.fxml.FXML;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.paint.Color;
import javafx.scene.image.WritableImage;
import javafx.scene.image.PixelWriter;
import javafx.scene.image.PixelFormat;
import javafx.scene.control.Label;
import org.example.pidev.model.Event;

import java.util.HashMap;
import java.util.Map;

public class QRCodeWindowController {

    @FXML
    private ImageView qrCodeImageView;

    @FXML
    private Label eventDetailsLabel;

    private Event event;

    public void setEvent(Event event) {
        this.event = event;
        generateQRCode();
        displayEventDetails();
    }

    private void generateQRCode() {
        if (event == null) return;

        try {
            // Prepare the event data as a string
            String eventData = "Event Name: " + event.getName() + "\n" +
                    "Description: " + event.getDescription() + "\n" +
                    "Date: " + event.getDate().toString() + "\n" +
                    "Location: " + event.getLocation() + "\n" +
                    "Organiser: " + event.getOrganiser() + "\n" +
                    "Event Type: " + event.getEventType() + "\n" +
                    "Number of Participants: " + event.getNbParticipant() + "\n" +
                    "Ticket Price: " + event.getTicketPrice() + "\n" +
                    "Formation: " + (event.isHasFormation() && event.getFormation() != null ? event.getFormation().getTitre() : "No Formation");

            // Generate the QR code from the event data
            MultiFormatWriter writer = new MultiFormatWriter();
            Map<EncodeHintType, String> hints = new HashMap<>();
            hints.put(EncodeHintType.CHARACTER_SET, "UTF-8");
            BitMatrix bitMatrix = writer.encode(eventData, BarcodeFormat.QR_CODE, 300, 300, hints);

            // Convert BitMatrix to an Image using WritableImage
            WritableImage writableImage = new WritableImage(bitMatrix.getWidth(), bitMatrix.getHeight());
            PixelWriter pixelWriter = writableImage.getPixelWriter();

            for (int y = 0; y < bitMatrix.getHeight(); y++) {
                for (int x = 0; x < bitMatrix.getWidth(); x++) {
                    pixelWriter.setColor(x, y, bitMatrix.get(x, y) ? Color.BLACK : Color.WHITE);
                }
            }

            // Set the generated QR code to the ImageView
            qrCodeImageView.setImage(writableImage);

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void displayEventDetails() {
        if (event != null) {
            String eventDetails = "Event Name: " + event.getName() ;
            eventDetailsLabel.setText(eventDetails);
        }
    }
}
