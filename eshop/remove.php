<?php
session_start();
include('connect.php'); // Include the file with the database connection

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check if the cart_id parameter exists in the URL
    if (isset($_GET['cart_id'])) {
        $cartId = $_GET['cart_id'];

        // Remove the book from the cart in the database
        $query = "DELETE FROM cart WHERE idcart = $cartId AND user_id = {$_SESSION['user_id']}";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            // Book removed successfully
            header("Location: cart.php");
            exit();
        } else {
            // Error occurred while removing the book
            echo 'Error: Unable to remove the book from the cart.';
        }
    } else {
        // cart_id parameter is missing
        echo 'Error: Missing cart_id parameter.';
    }
} else {
    // User is not logged in
    echo 'Error: User not logged in.';
}
?>