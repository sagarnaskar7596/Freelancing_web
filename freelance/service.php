<?php 
include 'includes/header.php'; 
require 'includes/db.php';
?>

<link rel="stylesheet" href="assets\css\service.css"> <!-- Link to the CSS file -->

<div class="services-container">
    <h1>Explore Freelance Services</h1>
    <div class="services-grid">
        <?php
        // Fetch services from the database
        $stmt = $pdo->prepare("SELECT s.title, s.description, s.price, u.username FROM services s JOIN users u ON s.user_id = u.user_id");
        $stmt->execute();
        $services = $stmt->fetchAll();

        // Check if services exist
        if (count($services) > 0) {
            foreach ($services as $service) {
                echo '<div class="service-card">';
                echo '<div class="service-image">';
                echo '<img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=1600" alt="Service Image">'; // Sample image, replace with actual if available
                echo '</div>';
                echo '<div class="service-info">';
                echo '<h3>' . htmlspecialchars($service['title']) . '</h3>';
                echo '<p>' . htmlspecialchars($service['description']) . '</p>';
                echo '<p class="price">Price: $' . htmlspecialchars($service['price']) . '</p>';
                echo '<p class="author">Offered by: ' . htmlspecialchars($service['username']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No services available at the moment. Check back later!</p>";
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
