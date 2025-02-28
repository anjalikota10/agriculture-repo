<?php
$conn=mysqli_connect("localhost","root","","agriculture");

session_start();
if(isset($_POST['login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];
        $sql="select count(id) from reg where email='$email' and password='$password'";
        $res=mysqli_query($conn,$sql);
        $rs=mysqli_fetch_row($res);
        if($rs[0]=='1'){
            $_SESSION['email'] = $email;
            echo "<script>
                    alert('Login successfully:');
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
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
        }

        h2 {
            text-align: center;
            font-size: 22px;
            color: #333;
            margin-bottom: 18px;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .input-group input:focus {
            border-color: #28a745;
            box-shadow: 0 0 6px rgba(40, 167, 69, 0.4);
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            background:#b0b435;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post">
           
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
           
            <button type="submit" name="login" class="btn">Login</button>
            <p>Don't have an account? <a href="reg.php">Register</a></p>

        </form>
    </div>
</body>
</html>
