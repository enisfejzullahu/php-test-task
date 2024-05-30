<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('includes/connect.php');

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['password'] == $password) {
            // User exists and password matches
            $_SESSION['username'] = $username;
            echo 'success';
        } else {
            // User exists but password does not match
            echo 'error';
        }
    } else {
        // User does not exist, insert into database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $username;
            echo 'success';
        } else {
            echo 'error';
        }
    }

    $conn->close();
    exit;
}
?>

<h2>Login</h2>
<form id="login-form">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    <button type="submit">Login</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#login-form').submit(function(event) {
        event.preventDefault();
        $.post('login.php', $(this).serialize(), function(response) {
            if (response == 'success') {
                location.reload(); // Reload the main page
            } else {
                alert('Invalid username or password');
            }
        });
    });
</script>
