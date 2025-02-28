<?php
include('header.php');
$id=$_GET['id'];
if(isset($_POST['update_category'])){
    
   
    $name=$_POST['name'];
    $description=$_POST['description'];
    $filename=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    $folder="./category_images/".$filename;

    if(move_uploaded_file($tempname,$folder))
    {
        $sql="update category  set name='$name',description='$description',image='$filename' where id='$id'";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo "<script>alert('Record Updated');
             window.location.href = 'category_table.php';
             </script>";
        }
        else{
            echo "<script>alert('Record Updation failed');</script>";  
        }
    }

}

?>
<?php
$query="select * from category where id='$id'";
$res1=mysqli_query($conn,$query);
$r=mysqli_fetch_row($res1);
$name=$r[1];
$desc=$r[2];
$image=$r[3];
?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Forms</a></li>
                                    <li class="active">Basic</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                   

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Category Form</strong></div>
                            <div class="card-body card-block">
                                <form method="post"  enctype='multipart/form-data'>
                                <div class="form-group"><label for="company" class=" form-control-label">Category Name</label><input type="text" id="company" placeholder="Enter Category Name" class="form-control" name="name" value="<?php echo $name;?>"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Description</label><input type="text" name="description" id="vat" placeholder="Enter Category Description" class="form-control" value="<?php echo $desc;?>"></div>
                               <img src="category_images/<?php echo $image;?>" height=100 width=100>
                                <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">File input</label></div>
                                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="image" class="form-control-file"></div>
                                </div>
                                <button type="submit" name="update_category" class="btn btn-outline-primary">Update Category</button>


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
                <div class="col-sm-6 text-right">
                    Designed by <a href="https://colorlib.com">Colorlib</a>
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
