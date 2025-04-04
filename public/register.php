<?php
session_start();

if (isset($_POST['Register'])) {
    require "../src/common.php";

    try {
        require_once '../src/DBconnect.php';

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);


        $new_user = array(
            "username" => escape($username),
            "password" => escape($password)
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)", "login",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

    } catch (PDOException $error) {
        echo "<p style='color:red;'>Database error: " . $error->getMessage() . "</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;'>Validation error: " . $e->getMessage() . "</p>";
    }
}

if (isset($_POST['Register']) && isset($statement) && $statement) {
    echo "<p style='color:green;'>" . htmlspecialchars($new_user['username']) . " successfully registered.</p>";
}
?>

<?php include "../template/header1.php"; ?>
<h2>Register a new user</h2>
<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username"
           pattern="^[a-zA-Z]{4,10}$"
           title="Username must be 4-10 letters only. No numbers or symbols allowed."
           required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password"
           pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$"
           title="Password must be at least 4 characters, with at least one letter and one number. Only letters and numbers allowed."
           required>

    <button type="submit" name="Register" value="Register">Register</button>
</form>

<a href="index.php">Back to home</a>

<?php include "../template/footer.php"; ?>