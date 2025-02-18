package org.example.pidev.service;

import org.example.pidev.model.Event;
import org.example.pidev.model.Formation;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class DatabaseService {

    private static final String JDBC_URL = "jdbc:mysql://localhost:3306/carrerbridge"; // Replace with your DB URL
    private static final String USERNAME = "root"; // Your DB username
    private static final String PASSWORD = ""; // Your DB password

    // Method to establish a database connection
    public static Connection getConnection() throws SQLException {
        return DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD);
    }

    // ✅ Insert an event into the database (supports linking to formations)
    public int addEvent(Event event) {
        String sql = "INSERT INTO events (name, description, date, location, organiser, event_type, nb_participant, ticket_price, has_formation, formation_id) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {

            statement.setString(1, event.getName());
            statement.setString(2, event.getDescription());
            statement.setDate(3, Date.valueOf(event.getDate()));
            statement.setString(4, event.getLocation());
            statement.setString(5, event.getOrganiser());
            statement.setString(6, event.getEventType());
            statement.setInt(7, event.getNbParticipant());
            statement.setFloat(8, event.getTicketPrice());
            statement.setBoolean(9, event.isHasFormation());

            if (event.getFormation() != null) {
                statement.setInt(10, event.getFormation().getId()); // Store Formation ID
            } else {
                statement.setNull(10, Types.INTEGER); // No Formation linked
            }

            statement.executeUpdate();

            // Retrieve the generated event ID
            ResultSet generatedKeys = statement.getGeneratedKeys();
            if (generatedKeys.next()) {
                return generatedKeys.getInt(1); // Return the newly created event ID
            }
        } catch (SQLException e) {
            System.err.println("Error adding event to the database: " + e.getMessage());
        }
        return -1; // Indicate failure
    }

    // ✅ Retrieve all events from the database, including linked formations
    public List<Event> getAllEvents() {
        List<Event> events = new ArrayList<>();
        String sql = "SELECT e.*, f.id AS formation_id, f.titre, f.description AS formation_description, f.duree, f.prix, " +
                "f.type, f.formateur, f.nbParticipant, f.status " +
                "FROM events e " +
                "LEFT JOIN formation f ON e.formation_id = f.id";

        try (Connection connection = getConnection();
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(sql)) {

            while (resultSet.next()) {
                Formation formation = null;

                // If the event has a formation, fetch its details
                if (resultSet.getBoolean("has_formation") && resultSet.getInt("formation_id") > 0) {
                    formation = new Formation(
                            resultSet.getInt("formation_id"),
                            resultSet.getString("titre"),
                            resultSet.getString("formation_description"),
                            resultSet.getString("duree"),
                            resultSet.getFloat("prix"),
                            resultSet.getString("type"),
                            resultSet.getString("formateur"),
                            resultSet.getInt("nbParticipant"),
                            resultSet.getString("status")
                    );
                }

                // Create and add event to the list
                events.add(new Event(
                        resultSet.getInt("id"),
                        resultSet.getString("name"),
                        resultSet.getString("description"),
                        resultSet.getDate("date").toLocalDate(),
                        resultSet.getString("location"),
                        resultSet.getString("organiser"),
                        resultSet.getString("event_type"),
                        resultSet.getInt("nb_participant"),
                        resultSet.getFloat("ticket_price"),
                        resultSet.getBoolean("has_formation"),
                        resultSet.getInt("formation_id"),
                        formation
                ));
            }
        } catch (SQLException e) {
            System.err.println("Error retrieving events from the database: " + e.getMessage());
        }

        return events;
    }

    // ✅ Update an event to set the `formation_id` when a formation is added
    public void updateEventFormation(int eventId, int formationId) {
        String sql = "UPDATE events SET has_formation = ?, formation_id = ? WHERE id = ?";

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setBoolean(1, true);
            statement.setInt(2, formationId);
            statement.setInt(3, eventId);

            statement.executeUpdate();
            System.out.println("Event " + eventId + " updated with Formation ID: " + formationId);

        } catch (SQLException e) {
            System.err.println("Error updating event formation: " + e.getMessage());
        }
    }

    // ✅ Initialize the database (create tables if they don't exist)
    public void initializeDatabase() {
        String sqlFormation = "CREATE TABLE IF NOT EXISTS formation (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "titre VARCHAR(255) NOT NULL, " +
                "description TEXT, " +
                "duree VARCHAR(50), " +
                "prix FLOAT NOT NULL, " +
                "type VARCHAR(100), " +
                "formateur VARCHAR(255), " +
                "nbParticipant INT, " +
                "status VARCHAR(50)" +
                ")";

        String sqlEvents = "CREATE TABLE IF NOT EXISTS events (" +
                "id INT AUTO_INCREMENT PRIMARY KEY, " +
                "name VARCHAR(255) NOT NULL, " +
                "description TEXT, " +
                "date DATE NOT NULL, " +
                "location VARCHAR(255) NOT NULL, " +
                "organiser VARCHAR(255) NOT NULL, " +
                "event_type VARCHAR(255) NOT NULL, " +
                "nb_participant INT NOT NULL, " +
                "ticket_price FLOAT NOT NULL, " +
                "has_formation BOOLEAN DEFAULT FALSE, " +
                "formation_id INT NULL, " +
                "FOREIGN KEY (formation_id) REFERENCES formation(id) ON DELETE SET NULL" +
                ")";

        try (Connection connection = getConnection();
             Statement statement = connection.createStatement()) {

            statement.execute(sqlFormation); // Create formation table first
            statement.execute(sqlEvents);    // Create events table after (to avoid FK issues)

            System.out.println("Database initialized: Tables created or already exist.");

        } catch (SQLException e) {
            System.err.println("Error initializing database: " + e.getMessage());
        }
    }
}
