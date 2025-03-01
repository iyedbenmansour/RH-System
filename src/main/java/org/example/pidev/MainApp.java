package org.example.pidev;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;

public class MainApp extends Application {

    @Override
    public void start(Stage primaryStage) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/org/example/pidev/event_form.fxml"));
            Parent root = loader.load();

            primaryStage.setTitle("Event Management System");
            primaryStage.setScene(new Scene(root, 1500, 800));
            primaryStage.show();
        } catch (Exception e) {
            System.err.println("Error loading event_form.fxml: " + e.getMessage());
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        launch(args);
    }
}
