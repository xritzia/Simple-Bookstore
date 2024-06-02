<?php
session_start();

// Register Success
if (isset($_SESSION["registration_success"]) && $_SESSION["registration_success"]) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("Account created successfully!", "Welcome to Book 101!", "success");
    });
    </script>';
    // Reset the session variable to prevent showing the alert again
    $_SESSION["registration_success"] = false;
}

// User already exists
if (isset($_SESSION["register_error"]) && $_SESSION["register_error"]) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("User already exists!", "Use a different email to sign up", "error");
    });
    </script>';
    $_SESSION["register_error"] = false;
}


// Recipe post success
if (isset($_SESSION["post_success"]) && $_SESSION["post_success"]) {
    echo '<script>
    window.onload = function() {
        swal("Upload Successful", "The new book has been uploaded.", "success");
    };
    </script>';
    // Reset the session variable to prevent showing the alert again
    $_SESSION["post_success"] = false;
}

// Add to Cart Success
if (isset($_SESSION["cart_success"]) && $_SESSION["cart_success"]) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("Book added to cart", "The selected book has been added to your cart.", "success");
    });
    </script>';
    // Reset the session variable to prevent showing the alert again
    $_SESSION["cart_success"] = false;
}

// Add to Cart Error
if (isset($_SESSION["cart_error"]) && $_SESSION["cart_error"]) {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        swal("Book already in cart", "The selected book is already in your cart.", "info");
    });
    </script>';
    // Reset the session variable to prevent showing the alert again
    $_SESSION["cart_error"] = false;
}

// Include php
if (!isset($_SESSION['user_id'])) {
    $title = 'Book 101';
    include('header.php');
    include('logiregi.php');
    include('aboutus.php');
} else {
    $title = 'Welcome Back !';
    include('header.php');
    include('logout.php');
    include('usermenu.php');
}

?>


<H1 class="title">Books</H1>
<!-- Main Content -->
<main>
    <?php
    // Fetch books from the "book" table
    $query = "SELECT idbook, title, img, price, author FROM book";
    $result = mysqli_query($dbc, $query);

    // Check if there are any books
    if (mysqli_num_rows($result) == 0) {
        echo '<p class="nobooks">No books available.</p>';
    } else {
        // Display books in a table format
        echo '<table>';
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            // Start a new row after every third book
            if ($count % 3 == 0) {
                echo '<tr>';
            }

            echo '<td>';
            echo '<a href="display.php?id=' . $row['idbook'] . '"><img class="bookimg" src="' . $row['img'] . '" alt="Book Cover"></a><br>';
            echo '<a href="display.php?id=' . $row['idbook'] . '" class="booktitle1">' . $row['title'] . '</a><br>'; 
            echo '<p class="authornm">Written by: ' . $row['author'] . '</p>';
            echo '<button class="addcartbtn" onclick="addToCart(' . $row['idbook'] . ')">
                Add to Cart <i class="fa-solid fa-cart-shopping" style="color: #000000;"></i></button>';
            echo '<h6 class="pricetitle">Price: ' . number_format($row['price'], 2) . '&euro;</h6>';
           
            echo '</td>';

            // End the row after every third book
            if ($count % 3 == 2) {
                echo '</tr>';
            }

            $count++;
        }

        // Close the last row if there are fewer than three books
        if ($count % 3 != 0) {
            echo '</tr>';
        }

        echo '</table>';
    }

   // Close the database connection
   mysqli_close($dbc);
   ?>
</main>

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

<?php
include('footer.php');
?>