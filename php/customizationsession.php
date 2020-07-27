<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if(isset($_POST['request'])) {
    switch ($_POST['request']){
        case "setbajudesign":
            $_SESSION["bajudesignchoice"] = $_POST['id'];
            echo "success";
            if (isset($_POST['successurl'])) header('Location: '+ $_POST['successurl']);
            break;
        case "setkaindesign":
            $_SESSION["kaindesignchoice"] = $_POST['id'];
            echo "success";
            if (isset($_POST['successurl'])) header('Location: '+ $_POST['successurl']);
            break;
        case "setbajunote":
            $_SESSION["bajunote"] = $_POST['note'];
            echo "baju note changed";
            break;
        case "setkainnote":
            $_SESSION["kainnote"] = $_POST['note'];
            echo "kain note changed";
            break;
        case "getbajudesign":
            if (isset($_SESSION["bajudesignchoice"])) echo $_SESSION["bajudesignchoice"];
            break;
        case "getkaindesign":
            if (isset($_SESSION["kaindesignchoice"])) echo $_SESSION["kaindesignchoice"];
            break;
        case "getbajunote":
            if (isset($_SESSION["bajunote"])) echo $_SESSION["bajunote"];
            break;
        case "getkainnote":
            if (isset($_SESSION["kainnote"])) echo $_SESSION["kainnote"];
            break;
        case "setsize":
            $_SESSION["size"] = $_POST{'size'};
            echo "size changed";
            break;
        case "getsize":
            if (isset($_SESSION["size"])) echo $_SESSION['size'];
            break;
    }
}
?>