package org.example.pidev.service;

import org.example.pidev.model.Event;
import org.example.pidev.model.Formation;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class EventService {

    private final DatabaseService databaseService = new DatabaseService();

    public EventService() {
        databaseService.initializeDatabase();
    }

    // ✅ Add a new event and return the generated ID
    public int addEvent(Event event) {
        String sql = "INSERT INTO events (name, description, date, location, organiser, event_type, nb_participant, ticket_price, has_formation, formation_id) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try (Connection connection = databaseService.getConnection();
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
                statement.setInt(10, event.getFormation().getId()); // Link Formation
            } else {
                statement.setNull(10, Types.INTEGER); // No formation linked
            }

            statement.executeUpdate();

            // Retrieve generated event ID
            ResultSet generatedKeys = statement.getGeneratedKeys();
            if (generatedKeys.next()) {
                int eventId = generatedKeys.getInt(1);
                event.setId(eventId);
                return eventId; // Return the event ID
            }

        } catch (SQLException e) {
            System.err.println("Error adding event: " + e.getMessage());
        }
        return -1; // Indicate failure
    }

    // ✅ Update an event’s formation details (set has_formation and link formation_id)
    public void updateEventFormation(int eventId, int formationId) {
        String sql = "UPDATE events SET has_formation = 1, formation_id = ? WHERE id = ?";

        try (Connection connection = databaseService.getConnection();
             PreparedStatement pstmt = connection.prepareStatement(sql)) {

            pstmt.setInt(1, formationId);
            pstmt.setInt(2, eventId);
            pstmt.executeUpdate();
            System.out.println("✅ Event " + eventId + " updated with Formation ID: " + formationId);

        } catch (SQLException e) {
            System.err.println("❌ Error updating event formation: " + e.getMessage());
        }
    }

    // ✅ Retrieve all events (including linked Formation details)
    public List<Event> getAllEvents() {
        List<Event> events = new ArrayList<>();
        String sql = "SELECT e.*, f.id AS formation_id, f.titre, f.description AS formation_description, f.duree, f.prix, " +
                "f.type, f.formateur, f.nbParticipant, f.status " +
                "FROM events e " +
                "LEFT JOIN formation f ON e.formation_id = f.id";

        try (Connection connection = databaseService.getConnection();
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(sql)) {

            while (resultSet.next()) {
                Formation formation = null;

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

                Event event = new Event(
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
                );
                events.add(event);
            }

        } catch (SQLException e) {
            System.err.println("Error retrieving events: " + e.getMessage());
        }

        return events;
    }

    // ✅ Update an existing event's details
    public void updateEvent(Event event) {
        String sql = "UPDATE events SET name = ?, description = ?, date = ?, location = ?, organiser = ?, event_type = ?, nb_participant = ?, ticket_price = ?, has_formation = ?, formation_id = ? WHERE id = ?";

        try (Connection connection = databaseService.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

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
                statement.setInt(10, event.getFormation().getId());
            } else {
                statement.setNull(10, Types.INTEGER);
            }

            statement.setInt(11, event.getId());

            statement.executeUpdate();
            System.out.println("Event updated successfully: " + event.getName());

        } catch (SQLException e) {
            System.err.println("Error updating event: " + e.getMessage());
        }
    }

    // ✅ Delete an event from the database
    public void deleteEvent(Event event) {
        String sql = "DELETE FROM events WHERE id = ?";

        try (Connection connection = databaseService.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setInt(1, event.getId());
            statement.executeUpdate();
            System.out.println("Event deleted successfully: " + event.getName());

        } catch (SQLException e) {
            System.err.println("Error deleting event: " + e.getMessage());
        }
    }

    // ✅ Retrieve an event by ID, including linked formation details
    public Event getEventById(int id) {
        String sql = "SELECT e.*, f.id AS formation_id, f.titre, f.description AS formation_description, f.duree, f.prix, " +
                "f.type, f.formateur, f.nbParticipant, f.status " +
                "FROM events e " +
                "LEFT JOIN formation f ON e.formation_id = f.id " +
                "WHERE e.id = ?";

        try (Connection connection = databaseService.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setInt(1, id);
            ResultSet resultSet = statement.executeQuery();

            if (resultSet.next()) {
                Formation formation = null;

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

                return new Event(
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
                );
            }

        } catch (SQLException e) {
            System.err.println("Error fetching event by ID: " + e.getMessage());
        }

        return null;
    }
    public List<Event> getEventsByName(String name) {
        List<Event> events = new ArrayList<>();
        String sql = "SELECT e.*, f.id AS formation_id, f.titre, f.description AS formation_description, f.duree, f.prix, " +
                "f.type, f.formateur, f.nbParticipant, f.status " +
                "FROM events e " +
                "LEFT JOIN formation f ON e.formation_id = f.id " +
                "WHERE e.name LIKE ?";

        try (Connection connection = databaseService.getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setString(1, "%" + name + "%"); // Enable wildcard search
            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                Formation formation = null;

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

                Event event = new Event(
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
                );
                events.add(event);
            }

        } catch (SQLException e) {
            System.err.println("Error fetching events by name: " + e.getMessage());
        }

        return events;
    }
}
