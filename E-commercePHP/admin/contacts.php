<?php

include ('../config.php');

session_start();

$admin_id = $_SESSION['admin_id'];
//Check if user exist else send back to php
if (!isset($admin_id)) {
    header('location:login.php');
}
//Delete message 
if (isset($_GET['delete'])) { 
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'")
    or die('query failed');
    header('location: contacts.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="../admin/css/admin_panel.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>
</head>

<body>
    <?php include('../admin/header.php'); ?>

    <section class="messages">
        <h1 class="title">messages</h1>
        <div class="box-container">
            <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            if(mysqli_num_rows($select_messages) > 0){
                while($fetch_messages= mysqli_fetch_assoc($select_messages)){
            
            ?>
            <div class="box">
                <p>name : <span><?php echo $fetch_messages['name'];?></span></p>
                <p>number : <span><?php echo $fetch_messages['number'];?></span></p>
                <p>email : <span><?php echo $fetch_messages['email'];?></span></p>
                <p>message : <span><?php echo $fetch_messages['message'];?></span></p>

                <a href="contacts.php?delete=<?php echo $fetch_messages['id']; ?>" 
                onclick="return confirm('delete this message?')" class="delete-btn">delete message</a>
            </div>
            <?php
                }
            }else{
                echo '<p class="empty">You hav no message yet! </p>';
            }
            ?>
        </div>
    </section>

    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../admin/js/main.js"></script>
</body>

</html>