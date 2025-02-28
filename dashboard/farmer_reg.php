<?php
$conn=mysqli_connect("localhost","root","","agriculture");
if(isset($_POST['farmer_reg'])){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
        $sql="insert into farmer_reg(name,email,password,contact,address) values('$name','$email','$password','$contact','$address')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo "<script>
            alert('Registration successfully:');
            window.location.href = 'farmer_login.php';
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
    <h2>Farmer Registration</h2>

    <form method="post">
    <input type="text" id="username" name="name" placeholder="Enter Name" required>
      <input type="email" id="username" name="email" placeholder="Enter Email" required>
      <input type="password" id="password" name="password" placeholder="Enter Password" required>
      <input type="text" id="password" name="contact" placeholder="Enter Contact No" required>
      <input type="text" id="password" name="address" placeholder="Enter Address" required>
      <button type="submit" name="farmer_reg">Registration</button>
    </form>
  </div>
</div>
</body>
</html>
   
