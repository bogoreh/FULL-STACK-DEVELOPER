<?php
include_once '../config/database.php';
include_once '../classes/User.php';
include_once '../includes/auth.php';

if(isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if($_POST) {
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    
    if($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        header("Location: ../index.php");
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BookMyShow Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <div class="auth-form">
            <h2>Login to Your Account</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>