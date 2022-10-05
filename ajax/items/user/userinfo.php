<?php
    // We require these values.
    if(!empty($id) && !empty($value)) {
        // Are you logged in?
        if(!empty($_SESSION['user'])) {
            /**
             * Switching it up!
             * Checking to change base values of the user.
             * Like email, Firstname lastname. Not password, will be in a different place tho. Safety.
             */
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
                        // Email already being used by an other account.
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
                    // A unknown value has been given.
                    echo error('ajax', 'unknownvalue');
                    break;
            }
        } else {
            // Please log in before using anything.
            echo error('ajax', 'notloggedin');
        }
    } else {
        // A value is not known.
        echo error('ajax', 'emptyvalues');
    }
?>