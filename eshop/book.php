<?php 
    //Book form page
    session_start();
    // Check if user is loged in
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])){
        // Redirect to index.php if not loged in
        header("Location: index.php");
    } else{
        // Change Title
        $title = 'Upload a Book';
        include('header.php');
        include('logout.php');
        include('bookform.php');
        include('footer.php');
    }
?>