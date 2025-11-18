<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    deleteNews($_GET['id']);
}

header("Location: index.php");
exit();
?>