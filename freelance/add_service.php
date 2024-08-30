<?php 
include 'includes/header.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];

    // File Upload Configurations
    $uploadDir = 'uploads/'; // Directory to save uploaded files
    $iconPath = '';
    $projectFilesPath = '';

    // Handle Icon Upload
    if (!empty($_FILES['icon']['name'])) {
        $iconName = basename($_FILES['icon']['name']);
        $iconPath = $uploadDir . uniqid() . '-' . $iconName;
        move_uploaded_file($_FILES['icon']['tmp_name'], $iconPath);
    }

    // Handle Project Files Upload
    if (!empty($_FILES['project_files']['name'])) {
        $projectFileName = basename($_FILES['project_files']['name']);
        $projectFilesPath = $uploadDir . uniqid() . '-' . $projectFileName;
        move_uploaded_file($_FILES['project_files']['tmp_name'], $projectFilesPath);
    }

    // Insert Service Data into Database
    $stmt = $pdo->prepare("INSERT INTO services (user_id, title, description, price, icon, project_files) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $price, $iconPath, $projectFilesPath]);

    // Redirect to index.php after successful insertion
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
    <link rel="stylesheet" href="assets/css/add_service.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="add-service-container">
        <div class="form-wrapper">
            <h2>Add a New Service</h2>
            <form action="" method="POST" class="service-form" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Service Title" required>
                <textarea name="description" placeholder="Service Description" required></textarea>
                <input type="number" name="price" placeholder="Price" required>
                
                <label for="icon">Upload Your Icon (Profile Picture):</label>
                <input type="file" name="icon" accept="image/*">
                
                <label for="project_files">Upload Project Files (images, documents, etc.):</label>
                <input type="file" name="project_files" accept="image/*,application/pdf">
                
                <button type="submit" class="btn-submit">Add Service</button>
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
