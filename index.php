<?php
if (!isset($_SESSION)) {
    session_start();
}
include('inc.connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Book List PHP Web Application">
    <title>
        <?php
        $pages_titles = [
            'login' => 'Login - ',
            'register' => 'Register - '
        ];

        $current_page = !empty($_GET['p']) ? $_GET['p'] : 'login';
        echo isset($pages_titles[$current_page]) ? $pages_titles[$current_page] . 'E-Book' : 'E-Book';
        ?>
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <!-- NAV START -->
    <?php
    $current_page = !empty($_GET['p']) ? $_GET['p'] : 'login';
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav text-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link user-select-none fw-bold <?php echo $current_page == 'login' ? 'active' : ''; ?>" href="?p=login" <?php echo $current_page == 'login' ? 'aria-current="page"' : ''; ?>>Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=register" class="nav-link user-select-none fw-bold <?php echo $current_page == 'register' ? 'active' : ''; ?>" href="?p=register" <?php echo $current_page == 'register' ? 'aria-current="page"' : ''; ?>>Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAV END -->

    <div class="container">
        <!-- PAGES START -->
        <?php
        $pages_dir = 'pages';
        if (!empty($_GET['p'])) {
            $pages = scandir($pages_dir, 0);
            unset($pages[0], $pages[1]);

            $p = $_GET['p'];
            if (in_array($p . '.php', $pages)) {
                include($pages_dir . '/' . $p . '.php');
            } else {
                echo 'Page not found! :(';
            }
        } else {
            include($pages_dir . '/login.php');
        }
        ?>
        <!-- PAGES END -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>

</html>