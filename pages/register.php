<?php
require_once('./class/class.user.php');

if (isset($_POST['btnRegister'])) {
    $inputemail = $_POST["username"];
    $password = $_POST["password"];
    $retypepassword = $_POST["retypepassword"];
    $objUser = new User();

    // Periksa apakah username sudah terdaftar
    $objUser->username = $inputemail;
    $objUser->SelectOneUserByUsername();
    if ($objUser->id) {
        echo "<script>alert('Username already registered'); </script>";
    } else {
        if (strlen($password) < 8) {
            echo "<script>alert('Password must consist of at least 8 characters');</script>";
        } else if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
            echo "<script>alert('Password must only contain letters and numbers');</script>";
        } else if ($password == strtolower($password)) {
            echo "<script>alert('Password must contain capital letters');</script>";
        } else if ($password != $retypepassword) {
            echo "<script>alert('Password does not match, please check your password again');</script>";
        } else {
            $maxUserID = $objUser->getMaxUserID();
            $nextUserID = $maxUserID + 1;
            $objUser->id = $nextUserID;
            $objUser->username = $inputemail;
            $objUser->password = password_hash($password, PASSWORD_DEFAULT);
            $objUser->AddUser();

            echo "<script> alert('Registration successful, please login to your account'); </script>";
            echo '<script> window.location="index.php?p=login"; </script>';
        }
    }
}
?>

<div class="container d-flex flex-column justify-content-center align-items-center" id="form-input">
    <h1>Register</h1>
    <form action="" class="row g-3 justify-content-center" method="POST">
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="inputUsername">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="inputPassword">
        </div>
        <div class="mb-3">
            <label for="inputRetypePassword" class="form-label">Retype Password</label>
            <input name="retypepassword" type="password" class="form-control" id="inputRetypePassword">
        </div>
        <button name="btnRegister" type="submit" class="btn btn-primary">Register</button>
    </form>
</div>