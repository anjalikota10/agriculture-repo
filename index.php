<?php
include('header.php');


// Fetch categories
$categories = $conn->query("SELECT id, name FROM category");

// Fetch all products or products by category if 'cid' is passed
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$query = "SELECT p.*, c.name as category_name FROM product p INNER JOIN category c ON p.cid = c.id";
if ($cid > 0) {
    $query .= " WHERE p.cid = $cid";
}
$products = $conn->query($query);
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

    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="images/banner-01.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                            <p class="m-b-40">Taste the goodness of nature.</p>
                            <p><a class="btn hvr-hover" href="shop.php">Shop New</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-02.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                            <p class="m-b-40">Fresh from the farm, straight to your plate.</p>
                            <p><a class="btn hvr-hover" href="shop.php">Shop New</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-03.jpg" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Freshshop</strong></h1>
                            <p class="m-b-40">Fuel your day with the power of fruits and veggies.</p>
                            <p><a class="btn hvr-hover" href="shop.php">Shop New</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">

            <?php
            $sql="select * from category";
            $res=mysqli_query($conn,$sql);
            while($rs=mysqli_fetch_row($res)){
            ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="dashboard/category_images/<?php echo $rs[3];?>" alt="" style=" width: 100%; height: 300px;object-fit: cover; border-radius: 10px;">
                        <a class="btn hvr-hover" href="#"><?php echo $rs[1];?> </a>
                    </div>
                </div>
                <?php
                 }
                ?>
               
            </div>
        </div>
    </div>
    <!-- End Categories -->
	
	

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Fruits & Vegetables</h1>
                        
                    </div>
                </div>
            </div>


            <?php
$currentCid = isset($_GET['cid']) ? $_GET['cid'] : '0';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="special-menu text-center">
            <div class="button-group filter-button-group">
                <a href="?cid=0">
                    <button class="<?php echo $currentCid === '0' ? 'active' : ''; ?>">All</button>
                </a>
                <?php while ($category = $categories->fetch_assoc()) { ?>
                    <a href="?cid=<?php echo $category['id']; ?>">
                        <button class="<?php echo $currentCid == $category['id'] ? 'active' : ''; ?>">
                            <?php echo $category['name']; ?>
                        </button>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>



<div class="row special-list">
    <?php while ($product = $products->fetch_assoc()) { ?>
        <div class="col-lg-3 col-md-6 special-grid">
            <div class="products-single fix">
                <div class="box-img-hover">
                    <div class="type-lb">
                        <p class="sale"><?php echo $product['category_name']; ?></p>
                    </div>
                    <img src="dashboard/product_images/<?php echo $product['image']; ?>" class="img-fluid" alt="Image" style=" width: 100%; height: 200px;object-fit: cover; border-radius: 10px; ">
                    <div class="mask-icon">
                    </div>
                </div>
                <div class="why-text">
                    <h4><?php echo $product['name']; ?></h4>
                    <h5><?php echo $product['price']; ?>/-</h5>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>latest blog</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="dashboard/category_images/grains.jpeg" alt="" style=" width: 100%; height: 200px;object-fit: cover; border-radius: 10px;  "/>
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>GRAINS</h3>
                                <p> Grain foods are mostly made from wheat, oats, rice, rye, barley, millet, quinoa and corn. The different grains can be cooked and eaten whole, ground into flour to make a variety of cereal foods like bread, pasta and noodles, or made into ready-to-eat breakfast cereals.</p>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="dashboard/category_images/fruits.jpeg" alt="" style=" width: 100%; height: 200px;object-fit: cover; border-radius: 10px; " />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>FRUITS</h3>
                                <p>A fruit is the part of a flowering plant that contains the seeds. The skin of a fruit may be thin, tough, or hard. Its insides are often sweet and juicy. But some fruits, including nuts, are dry. Fruits develop from a plant's flowers..</p>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="dashboard/category_images/vegetables.jpeg" alt=""  style=" width: 100%; height: 200px;object-fit: cover; border-radius: 10px; "/>
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>VEGETABLES</h3>
                                <p>A vegetable is the edible portion of a plant. Vegetables are usually grouped according to the portion of the plant that is eaten such as leaves (lettuce), stem (celery), roots (carrot), tubers (potato), bulbs (onion) and flowers (broccoli). A fruit is the mature ovary of a plant.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog  -->


    <!-- Start Instagram Feed  -->
    
    <!-- End Instagram Feed  -->


    <!-- Start Footer  -->
  <?php
  include('footer.php');
  ?>