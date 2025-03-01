package org.example.pidev.service;

import org.example.pidev.model.Formation;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class FormationService {

    private static final String JDBC_URL = "jdbc:mysql://localhost:3306/carrerbridge";
    private static final String USERNAME = "root";
    private static final String PASSWORD = "";

    public Connection getConnection() throws SQLException {
        return DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD);
    }

    public List<Formation> getAllFormations() {
        List<Formation> formations = new ArrayList<>();
        String sql = "SELECT * FROM formation";

        try (Connection connection = getConnection();
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(sql)) {

            while (resultSet.next()) {
                Formation formation = new Formation(
                        resultSet.getInt("id"),
                        resultSet.getString("titre"),
                        resultSet.getString("description"),
                        resultSet.getString("duree"),
                        resultSet.getFloat("prix"),
                        resultSet.getString("type"),
                        resultSet.getString("formateur"),
                        resultSet.getInt("nbparticipant"),
                        resultSet.getString("status")
                );
                formations.add(formation);
            }

        } catch (SQLException e) {
            System.err.println("Error retrieving formations: " + e.getMessage());
        }

        return formations;
    }

    public int addFormation(Formation formation) {
        String sql = "INSERT INTO formation (titre, description, duree, prix, type, formateur, nbparticipant, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        int generatedId = -1;

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {

            statement.setString(1, formation.getTitre());
            statement.setString(2, formation.getDescription());
            statement.setString(3, formation.getDuree());
            statement.setFloat(4, formation.getPrix());
            statement.setString(5, formation.getType());
            statement.setString(6, formation.getFormateur());
            statement.setInt(7, formation.getNbParticipant());
            statement.setString(8, formation.getStatus());

            statement.executeUpdate();

            ResultSet generatedKeys = statement.getGeneratedKeys();
            if (generatedKeys.next()) {
                generatedId = generatedKeys.getInt(1);
            }

            System.out.println("Formation added: " + formation.getTitre());

        } catch (SQLException e) {
            System.err.println("Error adding formation: " + e.getMessage());
        }

        return generatedId;
    }
    public void deleteFormation(int formationId) {
        String sql = "DELETE FROM formation WHERE id = ?";

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setInt(1, formationId);
            statement.executeUpdate();

            System.out.println("Formation deleted: " + formationId);

        } catch (SQLException e) {
            System.err.println("Error deleting formation: " + e.getMessage());
        }
    }
    public void updateFormation(Formation formation) {
        String sql = "UPDATE formation SET titre = ?, description = ?, duree = ?, prix = ?, type = ?, formateur = ?, nbparticipant = ?, status = ? WHERE id = ?";

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setString(1, formation.getTitre());
            statement.setString(2, formation.getDescription());
            statement.setString(3, formation.getDuree());
            statement.setFloat(4, formation.getPrix());
            statement.setString(5, formation.getType());
            statement.setString(6, formation.getFormateur());
            statement.setInt(7, formation.getNbParticipant());
            statement.setString(8, formation.getStatus());
            statement.setInt(9, formation.getId());

            statement.executeUpdate();


            System.out.println("Formation updated: " + formation.getTitre());

        } catch (SQLException e) {
            System.err.println("Error updating formation: " + e.getMessage());
        }
    }

}
