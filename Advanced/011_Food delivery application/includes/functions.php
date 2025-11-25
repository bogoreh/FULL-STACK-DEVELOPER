<?php
session_start();

function getMenuItems($category = null) {
    global $pdo;
    
    $sql = "SELECT * FROM menu_items";
    if ($category) {
        $sql .= " WHERE category = ?";
    }
    $sql .= " ORDER BY category, name";
    
    $stmt = $pdo->prepare($sql);
    if ($category) {
        $stmt->execute([$category]);
    } else {
        $stmt->execute();
    }
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addToCart($itemId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId] += $quantity;
    } else {
        $_SESSION['cart'][$itemId] = $quantity;
    }
}

function getCartItems() {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return [];
    }
    
    global $pdo;
    $placeholders = str_repeat('?,', count($_SESSION['cart']) - 1) . '?';
    $sql = "SELECT * FROM menu_items WHERE id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array_keys($_SESSION['cart']));
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($items as &$item) {
        $item['quantity'] = $_SESSION['cart'][$item['id']];
    }
    
    return $items;
}

function getCartTotal() {
    $cartItems = getCartItems();
    $total = 0;
    
    foreach ($cartItems as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    return $total;
}

function clearCart() {
    unset($_SESSION['cart']);
}
?>