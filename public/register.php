<?php
session_start();
if (isset($_POST['Register'])) {  
    require "../src/common.php";
    try {
        require_once '../src/DBconnect.php';
        
        $new_user = array(
            "username" => escape($_POST['username']),
            "password" => escape($_POST['password'])
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)", "login",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}


if (isset($_POST['Register']) && $statement) {  
    echo $new_user['username']. ' successfully registered';
}
?>
<?php include "../template/header1.php"; ?>
<h2>Register a new user</h2>
<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    
    <button type="submit" name="Register" value="Register">Register</button>
</form>
<a href="index.php">Back to home</a>

<?php include "../template/footer.php"; ?>