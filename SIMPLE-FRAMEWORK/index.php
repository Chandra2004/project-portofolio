<?php
    $url = $_SERVER['REQUEST_URI'];
    $segment = explode('/', $url);

    function myDinamicLink($linkSegment, $lists, $listArray = null) {
        global $segment;
        if (isset($lists[0]) && is_array($lists[0])) {
            foreach ($lists as $list) {
                if ($listArray !== null && isset($list[$listArray])) {
                    if (isset($segment[$linkSegment]) && $segment[$linkSegment] === strtolower($list[$listArray])) {
                        return $list[$listArray];
                    }
                } else {
                    echo 'Key tidak ditemukan atau tidak valid.<br>';
                }
            }
        } else {
            foreach ($lists as $list) {
                if (isset($segment[$linkSegment]) && $segment[$linkSegment] === $list) {
                    return $list;
                }
            }
        }
    }

    require_once __DIR__ . '/Routes/web.php';
?>