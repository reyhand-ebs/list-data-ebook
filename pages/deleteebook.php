<?php
require_once('./class/class.ebook.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $objEbook = new Ebook();
    $objEbook->id = $id;
    $objEbook->DeleteEbook();
    echo "<script>
        showDeleteSuccessMessage('$objEbook->message');
    </script>";
} else {
    echo '<script>window.history.back()</script>';
}
