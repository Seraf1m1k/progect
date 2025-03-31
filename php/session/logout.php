<?php
    session_start();
    require_once "../session.php";
    EndSession();
    header("Location: ../../index.php");
?>