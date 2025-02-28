<?php
include('header.php');




if (isset($_GET['remove_id']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item1) {
        if ($item1['id'] == $_GET['remove_id']) {
            unset($_SESSION['cart'][$key]); 
            $_SESSION['cart'] = array_values($_SESSION['cart']); 
            echo "<script>
            alert('Product Deleted Successfully from Cart');
            window.location.href = 'cart.php';
            </script>";
            break;

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
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                        <li class="breadcrumb-item active"><a href="cart.php">Cart</a<</li>
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
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               $total=0;
                              if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $item) {
                                        $price=(int)$item['price']*(int)$item['qty'];
                                        $total+=$price;
                                ?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="<?php echo $item['image'];?>" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									<?php echo  $item['name'];?>
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p><?php echo  $item['price'];?></p>
                                    </td>
                                    <td><?php echo  $item['qty'];?></td>
                                    <td class="total-pr">
                                        <p><?php echo  $price; ?></p>
                                    </td>
                                    <td class="remove-pr">
                                    <a href="edit_quantity.php?edit_id=<?php echo urlencode($item['id']); ?>">
                                    <i class="fas fa-edit"></i>
                                    </a>

                                    </td>
                                    <td class="remove-pr">
                                    <a href="cart.php?remove_id=<?php echo urlencode($item['id']); ?>">
                                        <i class="fas fa-times"></i>
                                    </a>

                                    </td>

                                    </tr>
                                <?php
                               } 
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
              
                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <a href="shop.php"><input value="Add More Products" type="submit"></a>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"><?php echo $total;?>/-</div>
                        </div>
                        <?php
                        if($total>=500)
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
                            <div class="ml-auto font-weight-bold"><?php echo $discount;?>/-</div>
                        </div>
                            <?php
                         }
                        ?>
                        <hr class="my-1">
                        <!-- <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 10 </div>
                        </div> -->
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
                            <div class="ml-auto h5"><?php
                            $final=$total+2;
                            $bill=$final-$discount;
                            echo $bill;
                            ?></div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.php?bill=<?php echo $bill;?>" class="ml-auto btn hvr-hover">Checkout</a> </div>
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