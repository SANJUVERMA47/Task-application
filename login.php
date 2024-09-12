
<?php 
include("./loginconection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
       
       

  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    width: 100%;
   }

   .header{
    color:white;
   }

.background-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('login.jpg'); /* Replace with your image URL */
    background-size: cover;
    background-position: center;
    /* opacity: 0.8; */
}


.login-container {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}


.login-form {
    position: relative;
    max-width: 200px;
    margin: 50px auto;
    padding: 40px;
    background-color: rgba(255, 255, 255, 0.10);
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.login-form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
}

.input-group {
    margin-bottom: 25px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

.input-group input {
    margin:0 ;
    width: 100%;
    height: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"] {
    width: 100%;
    height: 40px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #2980b9;
}

p {
    text-align: center;
    margin-top: 20px;
    color: #666;
}

p a {
    text-decoration: none;
    color: #3498db;
}

    </style>
</head>
<body>
<div class="login-container">
    <div class="background-image"></div>
    <div class="login-form">
        <h2 class="header">Admin Login</h2>
        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
            </div>
            <button type="submit" name="submit">LOGIN</button>
        </form>
        <p>Forgot Password? <a href="#">Reset</a></p>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $user=$_POST['username'];
    $psd=$_POST['password'];
    $query="SELECT * FROM tasks WHERE username='$user' AND password='$psd'";
    $data= mysqli_query($conn,$query);
    $total= mysqli_num_rows($data);

    if($total==1){
        header('location:tasks.php');
    }else{
        echo "<script>alert('Incorrect username or password');</script>";
    }
}
?>
</body>
</html>




