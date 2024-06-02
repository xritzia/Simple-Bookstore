<?php

// Include sanitizeInput function
include('sanitizeInput.php');

// Include database connection
include('connect.php');

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve and sanitize the form data
  $name = sanitizeInput($_POST["name"]);
  $img = $_FILES["img"];
  $author = sanitizeInput($_POST["author"]);
  $price = sanitizeInput($_POST["price"]);
  $isbn = sanitizeInput($_POST["isbn"]);
  $descri = sanitizeInput($_POST["description"]);

  // Upload the image file
  if ($img["error"] == 0) {
    $imageTempPath = $img["tmp_name"];
    $extension = pathinfo($img["name"], PATHINFO_EXTENSION);
    $imageName = uniqid() . "." . $extension;
    $imagePath = "postimages/" . $imageName;

    if (move_uploaded_file($imageTempPath, $imagePath)) {
      // Image uploaded successfully
    } else {    
      die("Image upload error: Failed to move uploaded file.");
    }
  } else {
    die("Image upload error: No file uploaded or file upload error occurred.");
  }

  try {
    $stmt = $dbc->prepare("INSERT INTO book (title, img, author, price, isbn, descri) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdss", $name, $imagePath, $author, $price, $isbn, $descri);
    $stmt->execute();

    // Redirect the user back to the index.php
    $_SESSION["post_success"] = true;
    header("Location: index.php");
    exit();
  } catch (Exception $e) {
    die("Database Error: " . $e->getMessage());
  }
}

// Close the database connection
$dbc->close();

?>