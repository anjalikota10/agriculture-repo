<?php
$conn=mysqli_connect("localhost","root","","agriculture");
$id=$_GET['id'];
$sql="delete from category where id='$id'";
$res=mysqli_query($conn,$sql);
if($res){
    echo "<script>
                    alert('Category Deleted:');
                    window.location.href = 'category_table.php';
                  </script>";
}
?>