<?php
$conn=mysqli_connect("localhost","root","","agriculture");
$id=$_GET['id'];
$sql="delete from product where id='$id'";
$res=mysqli_query($conn,$sql);
if($res){
    echo "<script>
                    alert('Product Deleted:');
                    window.location.href = 'product_table.php';
                  </script>";
}
?>