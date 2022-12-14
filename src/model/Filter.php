<?php
// TODO mettre methode en static
class Filter {
    public function filterString($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }

    public function filterInt($int) {
        return filter_var($int, FILTER_SANITIZE_NUMBER_INT);
    }
}

?>