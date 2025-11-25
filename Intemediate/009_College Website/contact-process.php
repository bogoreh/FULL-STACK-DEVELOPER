<?php
include 'includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['message'] = "Please fill in all required fields.";
        header("Location: contact.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Please enter a valid email address.";
        header("Location: contact.php");
        exit();
    }

    try {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);

        $_SESSION['message'] = "Thank you for your message! We'll get back to you soon.";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Sorry, there was an error sending your message. Please try again.";
    }

    header("Location: contact.php");
    exit();
} else {
    header("Location: contact.php");
    exit();
}
?>