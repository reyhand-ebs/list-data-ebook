<?php
require_once('./class/class.user.php');

if (isset($_POST['btnLogin'])) {
    $inputemail = $_POST["username"];
    $password = $_POST["password"];
    $objUser = new User();

    $objUser->username = $inputemail;
    $objUser->SelectOneUserByUsername();

    if ($objUser->id) {
        if (password_verify($password, $objUser->password)) {
            $_SESSION['user_id'] = $objUser->id;
            $_SESSION['username'] = $objUser->username;
            echo '<script> window.location="dashboard.php"; </script>';
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Username not found');</script>";
    }
}
?>

<div class="container d-flex flex-column justify-content-center align-items-center" id="form-input">
    <h1>Login</h1>
    <form id="authForm" action="" class="row g-3 justify-content-center" method="POST">
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="inputUsername" autocomplete="username" required>
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPassword" autocomplete="username" required>
        </div>
        <button name="btnLogin" type="submit" class="btn btn-primary">Login</button>
    </form>
</div>