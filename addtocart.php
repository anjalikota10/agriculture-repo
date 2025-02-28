<?php
session_start();
    if(isset($_SESSION['email']))
    {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $product_id=$_POST['id'];
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_price = $_POST['product_price'];
    $quantity=$_POST['quantity'];
    $product_image=$_POST['product_image'];

    $product = [
        'id'=>$product_id,
        'name' => $product_name,
        'desc' => $product_desc,
        'price' => $product_price,
        'qty'=>$quantity,
        'image' => $product_image 
    ];

    $product_exists = false;
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['id'] == $product_id) {
            $product_exists = true;
            break;
        }
    }

    if (!$product_exists) {
        $_SESSION['cart'][] = $product;
        echo "<script>
                alert('Product Added to Cart!');
                window.location.href = 'cart.php';
              </script>";
    } else {
        echo "<script>
                alert('This product is already in your cart!');
                window.location.href = 'cart.php';
              </script>";
    }

}
 else {
    echo "<script>
            alert('Please Login First');
            window.location.href = 'login.php';
          </script>";
}
?>