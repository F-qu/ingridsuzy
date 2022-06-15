<?php

include 'config.php';

session_start();
// Security measure for all page check user authentication
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

//Insert in table cart
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart`
WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image)
VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')")
            or die('query failed');
        $message[] = 'product added to cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="products">

        <h1 class="title">Filter price</h1>

        <div class="flex">

            <div class="categories">
                <p style="padding-bottom: 1.8rem;">Products category</p>

                <p class="cat"><a href="#">BigBoypackz packs</a> </p>
                <hr>
                <p class="cat"> <a href="#">Top products</a> </p>
                <hr>
                <p class="cat"> <a href="#">Latest products </a></p>
                <hr>
                <p style="padding-top: 2rem; font-size: 1.8rem; opacity: 10;" class="cat">Filter by price</p>

                <div class="checkout">

                    <form action="" method="GET">

                        <div class="flex">

                            <div class="inputBox">
                                <span style="font-size: 1.5rem;">starting price</span>
                                <select style="font-size: 1.5rem;" name="start_price">
                                    <option value="0">$0</option>
                                    <option value="50">$50</option>
                                    <option value="100">$100</option>
                                    <option value="200">$200</option>
                                    <option value="500">$500</option>
                                </select>
                            </div>

                            <div class="inputBox">
                                <span style="font-size: 1.5rem;">ending price</span>
                                <select style="font-size: 1.5rem;" name="end_price">
                                    <option value="2000">$2000</option>
                                    <option value="1000">$1000</option>
                                    <option value="500">$500</option>
                                    <option value="300">$300</option>
                                </select>
                            </div>

                        </div>
                        <input type="submit" value="filter" class="btn" name="order_btn">
                    </form>
                </div>
            </div>

            <div class="box-container">

                <?php
                // FILTER BY PRICE IF ANY AMOUNT RANGE IS SET 
                if (!isset($_GET['start_price']) && !isset($_GET['end_price'])) {

                    $startprice = $_SESSION['start_price'];
                    $endprice = $_SESSION['end_price'];

                    $query_run = mysqli_query($conn, "SELECT * FROM products WHERE price BETWEEN $startprice AND $endprice")
                        or die('query failed');

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($query_run)) {

                ?>

                            <form action="" method="post" class="box">
                                <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <p style="font-family: 'Courier New', Courier, monospace; color: #666;">BigBoyPackzz</p>
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>

                                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                                <input style="padding-top: 1rem;" type="submit" class="btn" value="add to cart" name="add_to_cart">

                            </form>

                        <?php
                        }
                    }
                } else {

                    $startprice = $_GET['start_price'];
                    $endprice = $_GET['end_price'];

                    $query_run = mysqli_query($conn, "SELECT * FROM products WHERE price BETWEEN $startprice AND $endprice")
                        or die('query failed');

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($query_run)) {

                        ?>

                            <form action="" method="post" class="box">
                                <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <p style="font-family: 'Courier New', Courier, monospace; color: #666;">BigBoyPackzz</p>
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>

                                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                                <input style="padding-top: 1rem;" type="submit" class="btn" value="add to cart" name="add_to_cart">

                            </form>

                <?php
                        }
                    }
                }

                ?>
            </div>

        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>