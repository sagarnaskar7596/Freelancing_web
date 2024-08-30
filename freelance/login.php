<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="assets\css\login.css"> <!-- Link to the CSS file -->
<div class="login-container">
    <h2>Login to Your Account</h2>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'includes/db.php';
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
        } else {
            echo "<p class='error-msg'>Invalid login credentials.</p>";
        }
    }
    ?>
    <form action="" method="POST" class="login-form">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
