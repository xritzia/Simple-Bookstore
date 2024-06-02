<?php
// Start session
session_start();

// Title
$title = 'Cart';

// Include php files
if (!isset($_SESSION['user_id'])) {
    include('header.php');
    include('logiregi.php');
    include('backdisplay.php');
} else {
    include('header.php');
    include('logout.php');
    include('backdisplay.php');
}
?>

<H1 class="title">Cart</H1>
<!-- Main Content -->
<main class="containercart">
    <?php
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        // Fetch cart items for the logged-in user
        $userId = $_SESSION['user_id'];
        $query = "SELECT c.idcart, b.title, b.price FROM cart c
                  INNER JOIN book b ON c.book_idbook = b.idbook
                  WHERE c.user_id = $userId";
        $result = mysqli_query($dbc, $query);

        // Check if there are any items in the cart
        if (mysqli_num_rows($result) == 0) {
            echo '<p class="nobooks">Your cart is empty.</p>';
        } else {
            // Display cart items in a table format
            echo '<table>';
            echo '<tr>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>';

            $totalPrice = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['title'] . '</td>
                        <td>' . number_format($row['price'], 2) . '&euro;</td>
                        <td><a href="remove.php?cart_id=' . $row['idcart'] . '">Remove</a></td>
                      </tr>';
                $totalPrice += $row['price'];
            }

            echo '<tr>
                    <td><strong>Total:</strong></td>
                    <td><strong>' . number_format($totalPrice, 2) . '&euro;</strong></td>
                    <td></td>
                  </tr>';
            echo '<tr>
                    <td><button class="buy" type="button" name="buy" onclick="showAlert()">Buy</button></td>
                  </tr>';
            echo '</table>';
        }
    } else {
        echo '<p class="nobooks">Please log in to view your cart.</p>';
    }

    // Close the database connection
    mysqli_close($dbc);
    ?>
</main>

<!-- Buy Button alert -->
<script>
        function showAlert() {
            swal("Thank you for your purchase", "This is a demo", "success");
        }
</script>

<?php
include('footer.php');
?>