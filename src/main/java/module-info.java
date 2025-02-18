module org.example.pidev {
    requires javafx.controls;
    requires javafx.fxml;
    requires javafx.web;
    requires java.sql; // Add this line to require the java.sql module

    requires org.controlsfx.controls;
    requires com.dlsc.formsfx;
    requires net.synedra.validatorfx;
    requires org.kordamp.ikonli.javafx;
    requires org.kordamp.bootstrapfx.core;
    requires eu.hansolo.tilesfx;
    requires com.almasb.fxgl.all;

    opens org.example.pidev.controller to javafx.fxml;
    exports org.example.pidev.controller;
    exports org.example.pidev.model;
    exports org.example.pidev.service;
    exports org.example.pidev; // Export the main package

}