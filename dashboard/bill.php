<?php
$conn = mysqli_connect("localhost", "root", "", "agriculture");

$id = $_GET['id'];
$sql = "SELECT * FROM bill 
        INNER JOIN order_tbl ON bill.id = order_tbl.bid 
        INNER JOIN product ON product.id = order_tbl.pid 
        WHERE bill.id = '$id'";
$res = mysqli_query($conn, $sql);
$r = mysqli_fetch_assoc($res);
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .invoice-container { width: 80%; margin: auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .invoice-info { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .invoice-info .sender-info, .invoice-info .recipient-info { width: 45%; }
        .invoice-info h3 { margin-bottom: 10px; color: #333; }
        .invoice-info p { margin: 5px 0; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        .invoice-table th { background-color: #f4f4f4; color: #333; }
        .invoice-total { text-align: right; font-size: 18px; font-weight: bold; }
        .invoice-total p { margin-top: 10px; }
    </style>
</head>
<body>

<div class="invoice-container">
    <div class="invoice-info">
        <div class="sender-info">
            <h3>From:</h3>
            <p><strong>Name:</strong> Fresh Shop</p>
            <p><strong>Email:</strong> contactinfo@gmail.com</p>
            <p><strong>Contact:</strong> +1-888 705 770</p>
            <p><strong>Address:</strong> Michael I. Days 3756 Preston Street Wichita, KS 67213</p>
        </div>

        <div class="recipient-info">
            <h3>To:</h3>
            <p><strong>Name:</strong> <?php echo $r['fname'] . " " . $r['lname']; ?></p>
            <p><strong>Email:</strong> <?php echo $r['email']; ?></p>
            <p><strong>Address:</strong> <?php echo $r['address']; ?></p>
        </div>
    </div>

    <table class="invoice-table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $r['name']; ?></td>
                <td><?php echo $r['price']; ?></td>
                <td><?php echo $r['qty']; ?></td>
                <td><?php echo $r['total']; ?></td>
            </tr>
            <?php
            $total = $r['total']; // Initialize total
            while ($rs = mysqli_fetch_row($res)) {
                $total += $rs[14]; // Accumulate total
            ?>
            <tr>
                <td><?php echo $rs[18]; ?></td>
                <td><?php echo $rs[20]; ?></td>
                <td><?php echo $rs[12]; ?></td>
                <td><?php echo $rs[14]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Total Section -->
    <div class="invoice-total">
        <p><strong>Total: ₹<?php echo $total; ?></strong></p>

        <!-- Add Discount (Assuming a 10% discount) -->
        <?php 
        if($total>=500){
            $discount=100;
        ?>
        <p><strong>Discount -₹<?php echo $discount;?></strong></p>
        <?php
        }
        else{
            $discount=10;

            ?>
             <p><strong>Discount -₹<?php echo $discount;?></strong></p>
             <?php
        }

        ?>

        <!-- Add ₹2 Tax -->
        <?php $tax = 2; ?>
        <p><strong>Tax: ₹<?php echo $tax; ?></strong></p>

        <!-- Final Amount -->
        <?php $final_amount = $total - $discount + $tax; ?>
        <p><strong>Final Amount: ₹<?php echo number_format($final_amount, 2); ?></strong></p>
    </div>
</div>

</body>
</html>
