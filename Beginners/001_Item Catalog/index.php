<?php
// Include configuration and classes
include 'config/database.php';
include 'models/Item.php';
include 'controllers/ItemController.php';
include 'controllers/HomeController.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize controllers
$itemController = new ItemController($db);
$homeController = new HomeController();

// Get action from URL
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Route requests
switch($action) {
    case 'home':
        $data = $homeController->index();
        include 'views/home.php';
        break;
        
    case 'items':
        $items = $itemController->index();
        include 'views/items/index.php';
        break;
        
    case 'create':
        if($_POST) {
            $itemController->create($_POST);
        } else {
            include 'views/items/create.php';
        }
        break;
        
    case 'edit':
        if($_POST) {
            $itemController->update($_POST);
        } else {
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
            $item = $itemController->readOne($id);
            if($item) {
                include 'views/items/edit.php';
            } else {
                header("Location: index.php?action=items");
                exit();
            }
        }
        break;
        
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
        $itemController->delete($id);
        break;
        
    default:
        $data = $homeController->index();
        include 'views/home.php';
        break;
}
?>