<?php

class Toasts {
    public static function push($style, $title, $message) {
        echo "<scrtip>";
        echo "toasts.push({";
        echo "title: '" . $title . "',";
        echo "content: '" . $message . "',";
        echo "style: '" . $style . "'";
        echo "});";
        echo "</scrtip>";
    }
}