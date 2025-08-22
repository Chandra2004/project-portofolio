<?php
    require_once 'Controllers/Controller.php';
    require_once 'Controllers/HomepageController.php';

    use Controllers\HomepageController;

    $HomeController = new HomepageController();
    
    switch ($url) {
        // STATIC URL
        case '/' :
            $HomeController->Index();
        break;
        case '/users' :
            $HomeController->Users();
        break;


        // DYNAMIC URL
        case '/detail/user/' . $segment[3] . '/' . $segment[4]:
            $HomeController->Detail($segment[3], $segment[4]);
        break;

        default:
            echo 'tidak ada halaman';
        break;
    }
?>
