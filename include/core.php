<?php
// If true, show the page.
    if($pdoconn == true) {
        // If post values are being called.
        if(!empty($_POST)) {
            if(file_exists("./access/post/$page.php")) {
                include_once "./access/post/$page.php";
            }
        }

        // Ajax values are being called by javascript or other ideas.
        // Also showing pages and base index page.
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