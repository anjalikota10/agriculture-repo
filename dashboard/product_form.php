<?php
include('header.php');
if(isset($_POST['product'])){

    $cid=$_POST['cid'];
    $name=$_POST['name'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $filename=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    $folder="./product_images/".$filename;

    if($_SESSION['farmer_email']){
        $user_id=$farmer_id;
    }
    else{
        $user_id=0;
    }


    if(move_uploaded_file($tempname,$folder))
    {
        $sql="insert into product(cid,user_id,name,description,price,image) values('$cid','$user_id','$name','$description','$price','$filename')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo "<script>alert('Record Inserted');
               window.location.href = 'product_table.php';
               </script>";
        }
        else{
            echo "<script>alert('Record insertion failed');</script>";  
        }
    }

}

?>
        <!-- /header -->
        <!-- Header-->

      

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                   

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Product Form</strong></div>
                            <div class="card-body card-block">
                                <form method="post"  enctype='multipart/form-data'>
                                <div class="row form-group">
                                        <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Category</label></div>
                                        <div class="col-12 col-md-9">
                                            <select name="cid" id="selectSm" class="form-control-sm form-control">
                                                <?php
                                                $q="select id,name from category";
                                                $result=mysqli_query($conn,$q);
                                                while($r=mysqli_fetch_row($result)){
                                                ?>
                                                <option value="<?php echo $r[0];?>"><?php echo $r[1];?></option>
                                                <?php
                                                }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                               
                                <div class="form-group"><label for="company" class=" form-control-label">Product Name</label><input type="text" id="company" placeholder="Enter Product Name" class="form-control" name="name"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Description</label><input type="text" name="description" id="vat" placeholder="Enter Product Description" class="form-control"></div>
                                <div class="form-group"><label for="company" class=" form-control-label">Product Price</label><input type="text" id="company" placeholder="Enter Product Price" class="form-control" name="price"></div>

                                
                                <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">File input</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="image" class="form-control-file"></div>
                                </div>
                                <button type="submit" name="product" class="btn btn-outline-primary">Add Product</button>


                                </div>
                                </form>
                        </div>
                    </div>

                 

                   
                  
                   
                </div>

             

              

                

                
              

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-6">
                    Copyright &copy; 2018 Ela Admin
                </div>
             
            </div>
        </div>
    </footer>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
