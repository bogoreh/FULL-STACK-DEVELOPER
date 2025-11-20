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
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->phone = $_POST['phone'];
    
    if($user->emailExists()) {
        $error = "Email already exists.";
    } else {
        if($user->register()) {
            header("Location: login.php?registered=1");
        } else {
            $error = "Unable to register. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BookMyShow Clone</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <div class="auth-form">
            <h2>Create New Account</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>