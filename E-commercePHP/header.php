<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}


?>


<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-telegram"></a>
            <a href="#" class="fab fa-snapchat"></a>
         </div>
         <p> <a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>
   
   <div class="header-2">
      <div class="flex">
         <a style="display: flex;" href="home.php">
            <img src="images/wig.jpg" alt="" style="height: 70px; width: 70px;">
            <p style="color: white; font-size: 3rem; padding: 1.5rem; font-family: Roboto" >IngridWigShop</p>
         </a>
         
          <nav class="link-effect-3" id="link-effect-3" style="padding-left: 7rem;">
                    <a href="home.php" >Home</a>
                    <a href="about.php" >About</a>
                    <a href="shop.php" >Shop</a>
                    <a href="contact.php" >contact</a>
                    <a href="orders.php" >orders</a>
                </nav>
         
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
            //fetch the number of items added to the cart 
            $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'")
            or die('query failed');
            $cart_rows_number = mysqli_num_rows($select_cart_number);
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      </div>
   </div>

</header>
