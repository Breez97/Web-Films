<?php
    $descr=mysqli_connect("localhost", "root", "");
    mysqli_select_db($descr, "films_project");
    mysqli_set_charset($descr, "utf8");
?>