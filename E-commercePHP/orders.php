<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}
// Delete order
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id' ")
      or die('Query failed');
   header('location: orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3> <a style="color: #666;" onmouseout='this.style.color="#666"' onmouseover='this.style.color="#fff"' href="home.php">home </a> > your orders</h3>
   </div>
   
   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">

         <?php
         // Get all data from the table orders and display
         $order_query = mysqli_query($conn, "SELECT * FROM `orders`
         WHERE user_id = '$user_id'") or die('query failed');
         if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
         ?>
               <div class="box">
                  <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                  <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                  <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                  <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                  <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                  <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                  <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                  <p> total price : <span><?php echo $fetch_orders['total_price']; ?> CFA</span> </p>
                  <p> payment status : <span style="color:
         <?php if ($fetch_orders['payment_status'] == 'pending') {
                  echo 'red';
               } else {
                  echo 'green';
               } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>

                  <a href="orders.php?delete=<?php echo $fetch_orders['id']; ?> " onclick="return confirm('delete order?');" class="delete-btn" style="margin-left: 45%;">Delete order
                  </a>
               </div>

         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>


   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

   
</body>

</html>