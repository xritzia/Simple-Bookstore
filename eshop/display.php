<?php
session_start();

// Title
$title = 'Book 101';

// Include php
if (!isset($_SESSION['user_id'])) {
	include('header.php');
    include('logiregi.php');
    include('backdisplay.php');
} else {
	include('header.php');
    include('logout.php');
    include('backdisplay.php');
}

    $bookId = $_GET['id'];
    // Fetch book details based on the provided ID
    $query = "SELECT idbook, title, img, isbn, author, price, descri FROM book WHERE idbook = $bookId";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Display the book details
        echo '<div class="container">';
        echo '<img class="bookimg1" src="' . $row['img'] . '" alt="Book Cover"><br>';
        echo '<div class="segment">';
        echo '<button class="addcartbtn1" onclick="addToCart(' . $row['idbook'] . ')">Add to Cart <i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></button>';
        echo '<h5 class="pricetitle1">Price: ' . number_format($row['price'], 2) . '&euro;</h5>';
        echo '<h2>' . $row['title'] . '</h2>';
        echo '<p>ISBN: ' . $row['isbn'] . '</p>';
        echo '<p>Author: ' . $row['author'] . '</p><br>';
        echo '</div>';
        echo '<div class="segment">';
        echo '<h3>Description:</h3>';
        echo '<p>' . $row['descri'] . '</p>';
        echo '</div>';
        echo '</div>';
    } else {
        // Book not found
        echo 'Error: Book not found.';
    }

    // Close the database connection
    mysqli_close($dbc);


// Include Footer
include('footer.php');
?>

<script>
    function addToCart(bookId) {
        // Check if user is logged in
        var userId = '<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ""; ?>';

        if (userId !== '') {
            // User is logged in
            // Make an AJAX request to addtocart.php
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response from addtocart.php
                    console.log(this.responseText);
                    // Display SweetAlert message
                    if (this.responseText === "Product added to the cart successfully.") {
                        swal({
                            icon: 'success',
                            title: 'Book added to cart',
                            text: 'The selected book has been added to your cart.'
                        });
                    } else if (this.responseText === "Product already exists in the cart.") {
                        swal({
                            icon: 'info',
                            title: 'Book already in cart',
                            text: 'The selected book is already in your cart.'
                        });
                    }
                }
            };
            xhttp.open("GET", "addtocart.php?bookId=" + bookId, true);
            xhttp.send();
        } else {
            // User is not logged in
            // Display SweetAlert message
            swal({
                icon: 'info',
                title: 'Log in to add to cart',
                text: 'Please log in or create an account to add items to your cart.'
            });
        }
    }
</script>


