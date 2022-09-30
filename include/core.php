<?php
    if($pdoconn == true) {
        // include_once "./include/setup.php";
        if(!empty($_POST)) {
            if(file_exists("./access/post/$page.php")) {
                include_once "./access/post/$page.php";
            }
        }

        if($page == 'ajax') {
            include_once "./ajax/basis.php";
        } else if($page == 'index') {
            include_once './include/header.php';
            include_once './pages/index.php';
            include_once './include/footer.php';
        } else {
            if(file_exists("./pages/$page.php")) {
                include_once './include/header.php';
                include_once "./pages/$page.php";
                include_once './include/footer.php';
            }
        }
    }
?>