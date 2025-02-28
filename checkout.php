<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';



include('header.php');
$bill=$_GET['bill'];
if (isset($_POST['checkout'])) {
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    $sql = "INSERT INTO bill (fname, lname, email, address, city, zipcode, payment,total_amount) 
            VALUES ('$fname', '$lname', '$email', '$address', '$city', '$zipcode', 'cash on delivery', '$bill')";

    if(mysqli_query($conn, $sql)){
             $query1 = "SELECT MAX(id) AS max_id FROM bill";
             $result = mysqli_query($conn, $query1);
             $row = mysqli_fetch_assoc($result);
             $bid = $row['max_id'];
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $total=0;   
                    $pid=$item['id'];
                    $qty=$item['qty'];
                    $price=$item['price'];
                    $total=(int)$qty*(int)$price;
                    
                    $query="insert into order_tbl(bid,pid,qty,price,total) values('$bid','$pid','$qty','$price','$total')";
                    $rs=mysqli_query($conn,$query);
                    if($rs){
                       
                      unset($_SESSION['cart']);
                    } 
                }

                      $sql_email="SELECT * FROM bill INNER JOIN order_tbl ON bill.id = order_tbl.bid INNER JOIN product ON product.id =order_tbl.pid where bill.id='$bid'";
                        $res_email=mysqli_query($conn,$sql_email);
                    
                        $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'reservehub98@gmail.com';  // replace with your email
                        $mail->Password = 'aewbafexmwamnbse';  // replace with your email password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                
                        $mail->setFrom('reservehub98@gmail.com','Reserve Hub');  // replace with your email and name
                        $mail->addAddress($email);
                        $mail->addReplyTo('reservehub98@gmail.com','Reserve Hub');
                
                        $mail->isHTML(true);
                        $mail->Subject = 'Thank you For Booking...!!';
                
                      // Start building the table only once
// Start building the table only once
$mail->Body = "
<div style='max-width: 500px; margin: auto; padding: 20px; background-color: #f8f8f8; color: #333; font-family: Arial, sans-serif; border-radius: 10px;'>
    <h2 style='text-align: center; color: #333;'>Thank You for Your Order!</h2>
    <h3 style='text-align: center; color: #333;'>Order Details</h3>
    <table style='width: 100%; border-collapse: collapse;'>
        <thead>
            <tr style='background-color: #d4edda;'>
                <th style='border: 1px solid #ccc; padding: 10px; text-align: left;'>Product Name</th>
                <th style='border: 1px solid #ccc; padding: 10px; text-align: center;'>Quantity</th>
                <th style='border: 1px solid #ccc; padding: 10px; text-align: right;'>Price</th>
                <th style='border: 1px solid #ccc; padding: 10px; text-align: right;'>Sub Total</th>
            </tr>
        </thead>
        <tbody>";

// Initialize total price
$total = 0;

// Append rows for each product
while ($rs_email = mysqli_fetch_row($res_email)) {
    // Add each product price to the total
    $total += $rs_email[14]; // Assuming $rs_email[14] holds the subtotal for each product

    // Add each product row to the email body
    $mail->Body .= "
        <tr>
            <td style='border: 1px solid #ccc; padding: 10px;'>{$rs_email[18]}</td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: center;'>{$rs_email[12]}</td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'>{$rs_email[20]}/-</td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'>{$rs_email[14]}/-</td>
        </tr>";
}

// Apply discount and tax
$discount = 0;
if ($total > 500) {
    $discount = 100; // Discount of ₹100 if total is more than ₹500
} else {
    $discount = 10; // Discount of ₹10 if total is ₹500 or less
}

$tax = 2; // Flat tax of ₹2

// Calculate grand total
$grand_total = $total - $discount + $tax;

// Add the total row, discount, tax, and grand total to the email
$mail->Body .= "
        <tr>
            <td colspan='3' style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>Total Price</strong></td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>{$total}/-</strong></td>
        </tr>
        <tr>
            <td colspan='3' style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>Discount</strong></td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>-₹{$discount}/-</strong></td>
        </tr>
        <tr>
            <td colspan='3' style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>Tax</strong></td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>₹{$tax}/-</strong></td>
        </tr>
        <tr>
            <td colspan='3' style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>Grand Total</strong></td>
            <td style='border: 1px solid #ccc; padding: 10px; text-align: right;'><strong>₹{$grand_total}/-</strong></td>
        </tr>
    </tbody>
</table>";

// Close the email body
$mail->Body .= "
<p style='margin-top: 20px;'>If you have any questions, feel free to contact us.</p>
<hr style='border: 0.5px solid #ccc;'>
<h3 style='text-align: center; color: #333;'>Fresh Shop</h3>
<p><strong>Email:</strong> contactinfo@gmail.com</p>
<p><strong>Phone:</strong> +1-888 705 770</p>
<p><strong>Website:</strong> <a href='https://reservehub.com' style='color: #007bff; text-decoration: none;'>https://reservehub.com</a></p>
</div>";

// Send the email
$mail->send();
echo "<script>
    alert('Order placed and mail sent');
    window.location.href = 'index.php';
</script>";

                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    //mail code ended
                  
                    

                }
                    
                             
            }
    }  





?>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list">
                        <li>
                            <a href="#" class="photo"><img src="images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Delica omtantur </a></h6>
                            <p>1x - <span class="price">$80.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Omnes ocurreret</a></h6>
                            <p>1x - <span class="price">$60.00</span></p>
                        </li>
                        <li>
                            <a href="#" class="photo"><img src="images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">Agam facilisis</a></h6>
                            <p>1x - <span class="price">$40.00</span></p>
                        </li>
                        <li class="total">
                            <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: $180.00</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active"><a href="checkout.php">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
           
            <div class="row">
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                        </div>
                        <form class="needs-validation"  method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" name="fname" id="firstName" placeholder="" value="<?php echo $fname;?>" required readonly>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" name="lname" id="lastName" placeholder="" value="<?php echo $lname;?>"  required readonly>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">Email *</label>
                                    <input type="text" name="email" class="form-control" id="firstName" placeholder="" value="<?php echo $email;?>" required readonly>
                                    <div class="invalid-feedback"> Valid first name is required. </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Contact Number *</label>
                                    <input type="text" class="form-control" name="contact" id="lastName" placeholder="" value="<?php echo $contact;?>" required readonly>
                                    <div class="invalid-feedback"> Valid last name is required. </div>
                                </div>
                            </div>
                           
                           
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="" required readonly>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            
                                
                            <div class="row">
                               
                                <div class="col-md-4 mb-3">
                                    <label for="state">City *</label>
                                    <select class="wide w-100" id="city" name="city">
                                    <option value="mumbai">Mumbai</option>
                                    <option value="pune">Pune</option>
                                    <option value="nagpur">Nagpur</option>
                                    <option value="nashik">Nashik</option>
                                    <option value="thane">Thane</option>
                                    <option value="aurangabad">Aurangabad</option>
                                    <option value="solapur">Solapur</option>
                                    <option value="kolhapur">Kolhapur</option>
                                    <option value="amravati">Amravati</option>
                                    <option value="nanded">Nanded</option>
								</select>
                                    <div class="invalid-feedback"> Please provide a valid city </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" name="zipcode" id="zip" placeholder="" required>
                                    <div class="invalid-feedback"> Zip code required. </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Your Total Bill</label>
                                    <input type="text" class="form-control" id="zip"   value="<?php echo $bill;?>" readonly required>
                                </div>
                            </div>
                            <hr class="mb-4">
                          
                            <hr class="mb-4">
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="payment" type="radio" class="custom-control-input" value="cash on delivery"  checked required>
                                    <label class="custom-control-label" for="credit">Cash On delivery</label>

                                   
                                  
                                </div>
                            </div>
                            <button type="submit" name="checkout" class="ml-auto btn hvr-hover">Place Order</button>
                            <!-- <div class="col-12 d-flex shopping-box"> 
                               
                             </div> -->
                             </form>

                            <hr class="mb-1"> 
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                       
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Shopping cart</h3>
                                </div>
                                <div class="rounded p-2 bg-light">

                                <?php
                            $ftotal=0;
                              if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $item) {
                                        $total=0;
                                        $price=(int)$item['price']*(int)$item['qty'];
                                        $total+=$price;
                                        $ftotal+=$price;
                                ?>

                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html"><?php echo  $item['name'];?></a>
                                            <div class="small text-muted"><?php echo  $item['price'];?>/-<span class="mx-2">|</span> Qty:<?php echo  $item['qty'];?><span class="mx-2">|</span>Subtotal:<?php echo  $total;?></div>
                                        </div>
                                    </div>

                                <?php
                                    }
                                }
                                    ?>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"><?php echo $ftotal;?>/-</div>
                                </div>

                                <?php
                                 if($ftotal>=500)
                                 {
                                    $discount=100;
                                ?>
                                <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"><?php echo $discount;?>/-</div>
                                </div>
                                <?php
                                 }
                                 else
                                 {
                                    $discount=10;
                                ?>
                                 <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"><?php $discount;?>/-</div>
                                </div>
                                <?php
                                 }
                                ?>
                                <hr class="my-1">
                                
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold">2/-</div>
                                </div>
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold"> Free </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5">
                                    <?php
                                     echo $bill;
                                     ?>
                                    </div>
                                </div>
                                <hr> </div>
                        </div>
                        <!-- <div class="col-12 d-flex shopping-box"> <button type="submit" name="checkout" class="ml-auto btn hvr-hover">Place Order</button> </div>
                    </form> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
   
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
   <?php
   include('footer.php');
   ?>