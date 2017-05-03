<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.04.2017
 * Time: 21:58
 */

function GetParam($param_name, $default = NULL) {
    $result = $default;

    if (isset($_POST[$param_name])) {
        $result = $_POST[$param_name];
    }
    elseif (isset($_GET[$param_name])) {
        $result = $_GET[$param_name];
    }

    return $result;
}

//

$action = GetParam('action');
$model = GetParam('model');

switch ($action)
{
    case 'show':
        break;
    default:
        $action = null;
        break;
}

