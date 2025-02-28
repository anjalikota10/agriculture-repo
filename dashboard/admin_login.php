<?php
$conn=mysqli_connect("localhost","root","","agriculture");

session_start();
if(isset($_POST['admin_login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];
        $sql="select count(id) from admin where email='$email' and password='$password'";
        $res=mysqli_query($conn,$sql);
        $rs=mysqli_fetch_row($res);
        if($rs[0]=='1'){
            $_SESSION['admin_email'] = $email;
            echo "<script>
                    alert('Login successfully: " . $_SESSION['admin_email'] . "');
                    window.location.href = 'index.php';
                  </script>";
        }
        else{
            echo "<script>alert('Login failed);</script>";  
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
  font-family: "Comic Sans MS", cursive;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #f5f5f5;
  color: #333;
}

.container {
  width: 100%;
  max-width: 400px;
}

.card {
  width: 100%;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
}

form {
  display: flex;
  flex-direction: column;
}

input {
  padding: 10px;
  margin-bottom: 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  transition: border-color 0.3s ease-in-out;
  outline: none;
  color: #333;
}

input:focus {
  border-color:#3CB371;
}

button {
  background-color:#3CB371;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

button:hover {
    background-color:#3CB371;
}
    </style>
</head>

<body>
<div class="container">
  <div class="card">
    <h2>Admin Login</h2>

    <form method="post">
      <input type="email" id="username" name="email" placeholder="Enter Email" required>
      <input type="password" id="password" name="password" placeholder="Enter Password" required>
      <button type="submit" name="admin_login">Login</button>
    </form>
  </div>
</div>
</body>
</html>
   
