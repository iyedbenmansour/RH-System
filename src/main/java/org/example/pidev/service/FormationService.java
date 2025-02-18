package org.example.pidev.service;

import org.example.pidev.model.Formation;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class FormationService {

    private static final String JDBC_URL = "jdbc:mysql://localhost:3306/carrerbridge"; // Update if needed
    private static final String USERNAME = "root"; // Replace with your username
    private static final String PASSWORD = ""; // Replace with your password

    // ✅ Method to establish a database connection
    public Connection getConnection() throws SQLException {
        return DriverManager.getConnection(JDBC_URL, USERNAME, PASSWORD);
    }

    // ✅ Retrieve all formations
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
            System.err.println("❌ Error retrieving formations: " + e.getMessage());
        }

        return formations;
    }

    // ✅ Get a formation by ID
    public Formation getFormationById(int id) {
        String sql = "SELECT * FROM formation WHERE id = ?";

        try (Connection connection = getConnection();
             PreparedStatement statement = connection.prepareStatement(sql)) {

            statement.setInt(1, id);
            ResultSet resultSet = statement.executeQuery();

            if (resultSet.next()) {
                return new Formation(
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
            }

        } catch (SQLException e) {
            System.err.println("❌ Error retrieving formation by ID: " + e.getMessage());
        }

        return null;
    }

    // ✅ Modify `addFormation` to return the new formation ID
    public int addFormation(Formation formation) {
        String sql = "INSERT INTO formation (titre, description, duree, prix, type, formateur, nbparticipant, status) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try (Connection connection = getConnection();
             PreparedStatement pstmt = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {

            pstmt.setString(1, formation.getTitre());
            pstmt.setString(2, formation.getDescription());
            pstmt.setString(3, formation.getDuree());
            pstmt.setFloat(4, formation.getPrix());
            pstmt.setString(5, formation.getType());
            pstmt.setString(6, formation.getFormateur());
            pstmt.setInt(7, formation.getNbParticipant());
            pstmt.setString(8, formation.getStatus());

            pstmt.executeUpdate();

            // ✅ Retrieve generated formation ID
            ResultSet generatedKeys = pstmt.getGeneratedKeys();
            if (generatedKeys.next()) {
                int generatedId = generatedKeys.getInt(1);
                System.out.println("✅ Formation added with ID: " + generatedId);
                return generatedId;
            }

        } catch (SQLException e) {
            System.err.println("❌ Error adding formation: " + e.getMessage());
        }

        return -1; // Return -1 if insertion fails
    }
}
