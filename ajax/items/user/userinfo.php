<?php
    if(!empty($id) && !empty($value)) {
        if(!empty($_SESSION['user'])) {
            switch($id) {
                case 'email': 
                    $check = $pdo->query("SELECT * FROM `users` WHERE `email`='$value'")->fetch();
                    if(empty($check)) {
                        $do = $pdo->prepare("UPDATE `users` SET `email`='$value' WHERE `userid`='$userid'");
                        if($do->execute()) {
                            $succes['code'] = 200;
                            $succes['type'] = 'emchange';
                            $succes['message'] = 'Email succesfully changed';

                            echo json_encode($succes);
                            return;
                        }
                    } else {
                        echo error('ajax', 'emailalreadyinuse');
                    }
                    break;
                case 'firstname':
                case 'lastname':
                    $do = $pdo->prepare("UPDATE `userinfo` SET `$id`='$value' WHERE `userid`='$userid'");
                    if($do->execute()) {
                        $succes['code'] = 200;
                        $succes['type'] = 'changesuc';
                        $succes['message'] = "$id succesfully changed!";

                        echo json_encode($succes);
                        return;
                    } else {
                        echo error('ajax', 'pdoerror');
                    }
                    break;
                default:
                    echo error('ajax', 'unknownvalue');
                    break;
            }
        } else {
            echo error('ajax', 'notloggedin');
        }
    } else {
        echo error('ajax', 'emptyvalues');
    }
?>