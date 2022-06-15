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

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../admin/css/admin_panel.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header class="header">

    <div class="flex">
        <a href="index.php" class="logo"><span>IngridWigShop</span></a>
        
        <nav class="navbar">
            <a href="index.php">home</a>
            <a href="products.php">products</a>
            <a href="orders.php">orders</a>
            <a href="users.php">users</a> 
            <a href="contacts.php">messages</a>
        </nav>
        
        <div class="icons">
            <div id="menu-btn" class="fas fa fa-bars"></div>
            <div id="user-btn" class="fas fa fa-user"></div>
        </div>

        <div class="account-box">
            <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
            <a href="../logout.php" class="delete-btn">logout</a>
        </div>
    </div>
</header>

</body>
</html>
