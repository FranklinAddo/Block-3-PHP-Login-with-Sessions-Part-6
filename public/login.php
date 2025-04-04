<?php
require_once('config.php');
session_start();

if(isset($_POST['Submit'])) {
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    
    try {
        // Use the $db connection from config.php
        $stmt = $db->prepare("SELECT * FROM login WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            if($password == $user['password']) { 
                $_SESSION['Username'] = $user['username'];
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit;
            }
        }
        echo "Incorrect Username or Password";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/signin.css">
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
<title>Sign in</title>
</head>

<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername">Username</label>
        <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

        <br><br>
        <a href="register.php" class="button">Create an account</a>
    </form>
</div>
</body>
</html>