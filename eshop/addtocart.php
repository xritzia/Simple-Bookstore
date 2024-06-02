<?php
session_start();
require_once 'connect.php';

// Get the book ID from the request parameters
if (!isset($_GET['bookId'])) {
    echo "Book ID not provided.";
    exit;
}

$bookId = $_GET['bookId'];

$query = "SELECT idbook, title, img, isbn, author, price, descri FROM book WHERE idbook = $bookId";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to add items to your cart.";
    exit;
}

// Get the user ID from the session
$userID = $_SESSION['user_id'];

// Check if the product already exists in the user's cart
$stmt = $dbc->prepare("SELECT * FROM cart WHERE user_id = ? AND book_idbook = ?");
$stmt->bind_param("ii", $userID, $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Product already exists in the cart.";
    exit;
}

// Retrieve the product details from the book table
$stmt = $dbc->prepare("SELECT * FROM book WHERE idbook = ?");
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit;
}

$product = $result->fetch_assoc();

// Add the product to the cart table
$stmt = $dbc->prepare("INSERT INTO cart (price, user_id, book_idbook) VALUES (?, ?, ?)");
$stmt->bind_param("dii", $product['price'], $userID, $bookId);
$stmt->execute();

echo "Product added to the cart successfully.";

$stmt->close();
$dbc->close();
?>