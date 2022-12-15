<?php
class Validation {
    public static function filterString($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public static function filterInt($int) {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function actionRole($action) {
        return (empty($action)) ? null : explode("-",$action)[0];
    }
}

?>