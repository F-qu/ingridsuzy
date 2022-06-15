<?php

include ('../config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) { 
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'")
    or die('query failed');
    header('location: users.php');
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
    <title>users</title>
</head>

<body>
    <?php include('../admin/header.php'); ?>
    <section class="users">
        <h1 class="title">users accounts</h1>
        <div class="box-container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            while($fetch_users= mysqli_fetch_assoc($select_users)){
            ?>
            <div class="box">
            <p>username : <span><?php echo $fetch_users['name']; ?></span></p>
            <p>email : <span><?php echo $fetch_users['email']; ?></span></p>
            <p>user type : <span style="color: <?php if($fetch_users['user_type'] == 'admin'){echo 'var(--red)';} ?>;">
            <?php echo $fetch_users['user_type']; ?></span></p>

            <a href="users.php?delete=<?php echo $fetch_users['id']; ?>" 
            onclick="return confirm('delete this user?')" class="delete-btn">delete</a>
            </div>
            <?php
            }
            ?>
            
        </div>
    </section>


    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../admin/js/main.js"></script>
</body>

</html>