<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['send'])) {
   // Set data for the insert query
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name'
   AND email = '$email' AND number = '$number' AND message = '$msg'")
      or die('query failed');
   //Check if message does exist already 
   if (mysqli_num_rows($select_message) > 0) {
      $message[] = 'message sent already!';
      //Then insert 
   } else {
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) 
      VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3> <a style="color: #666;" onmouseout='this.style.color="#666"' 
      onmouseover='this.style.color="#fff"' href="home.php">home </a> > contact us</h3>
   </div>

   <div class="contact-info">

      <div class="box">
         <div class="box-1">
            <p><span>Address : </span>Cameroon center, <br> Yaounde messassi</p>
         </div>
      </div>
      <div class="box">
         <div class="box-1">
            <p><span>Email : </span>IngridWigShop@gamil.com</p>
         </div>
      </div>
      <div class="box">
         <div class="box-1">
            <p><span>Phone : </span>+237.650.098.315</p>
         </div>
      </div>

   </div>

   <section class="contact">

      <div class="flex">

         <form action="" method="post">
            <h3>say something!</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box">
            <input type="email" name="email" required placeholder="enter your email" class="box">
            <input type="number" name="number" required placeholder="enter your number" class="box">
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
         </form>
         
         <div class="image">
            <img src="images/IMG-20220614-WA0020.jpg" alt="">
         </div>
         
      </div>
      
   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>