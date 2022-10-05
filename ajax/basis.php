<?php
if (!empty($_POST)) {
    // Base values and making sure those values are being set.
    $page = $item = $value = $id = $array = $key = null;
    if (!empty($_POST['page'])) {
        $page = $_POST['page'];
    }
    if (!empty($_POST['item'])) {
        $item = $_POST['item'];
    }

    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    }

    if (!empty($_POST['value'])) {
        $value = $_POST['value'];
    }

    if (!empty($_POST['array'])) {
        $array = $_POST['array'];
    }

    // If document requires a api key.
    if (!empty($_GET)) {
        if (!empty($_GET['key'])) {
            $key = $_GET['key'];
        }
    }

    if (!empty($page)) {
        if (!empty($item)) {
            if (file_exists("./ajax/items/$page/$item.php")) {
                include_once "./ajax/items/$page/$item.php";
            } else {
                echo error('ajax', 'nopagefound');
                return;
            }
        } else {
            if (file_exists("./ajax/items/$page.php")) {
                include_once "./ajax/items/$page.php";
            } else {
                echo error('ajax', 'nopagefound');
                return;
            }
        }
    }
}
