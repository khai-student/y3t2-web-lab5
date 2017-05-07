<?php

class Utilities
{
    public function GetParam($param_name, $default = NULL) {
    if (isset($_POST[$param_name])) {
        return $_POST[$param_name];
    }
    if (isset($_GET[$param_name])) {
        return $_GET[$param_name];
    }
    else {
        return $default;
    }  
}
}