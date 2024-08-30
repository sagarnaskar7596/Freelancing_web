<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="assets\css\register.css"> <!-- Link to the CSS file -->
<div class="register-container">
    <h2>Create Your Account</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'includes/db.php';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $role]);
        echo "<p class='success-msg'>Registration successful. <a href='login.php'>Login here</a></p>";
    }
    ?>
    <form action="" method="POST" class="register-form">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="freelancer">Freelancer</option>
            <option value="client">Client</option>
        </select>
        <button type="submit">Register</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
