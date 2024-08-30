<?php 
include 'includes/header.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<link rel="stylesheet" href="assets\css\dashboard.css"> <!-- Link to the CSS file -->

<div class="dashboard-container">
    <div class="welcome-message">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <p>Manage your services or explore new opportunities!</p>
        <a href="add_service.php" class="btn btn-primary">Add New Service</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
