<?php

/**
 * Function Error
 * @param string $type 'Give a value'
 * @param string $value 'Give a value of the error'
 * @return json 'Return a the error value in text'
 */

function error($type, $value)
{
    $error = null;
    if ($type == 'ajax') {
        switch ($value) {
            case 'nopagefound':
                $error['code'] = 404;
                $error['type'] = 'PGNFND';
                $error['message'] = 'This page has not been found, please try again!';
                break;
            case 'emptyvalues':
                $error['code'] = 404;
                $error['type'] = 'EMPVAL';
                $error['message'] = 'Please, fill in all values before continuing';
                break;
            case 'notloggedin':
                $error['code'] = 404;
                $error['type'] = 'PNTLOGIN';
                $error['message'] = 'Please log in before continuing this action.';
                break;
            case 'unknownvalue':
                $error['code'] = 404;
                $error['type'] = 'UKNWNVAL';
                $error['message'] = 'An unknown value has been given, please try again with a know value...';
                break;
            case 'emailalreadyinuse':
                $error['code'] = 404;
                $error['type'] = 'EMALNUSE';
                $error['message'] = 'This Email is already being used, please try again later!';
                break;
            case 'pdoerror': 
                $error['code'] = 404;
                $error['type'] = 'PDERRN';
                $error['message'] = 'Something went wrong on my end. If this continues to happen, please let me know at <a href="mailto:info@zerdardian.com">info@zerdardian.com</a>';
                break;
            default:
                $error['code'] = 200;
                $error['type'] = null;
                $error['message'] = 'no error found';
        }
    }
    return json_encode($error);
}
