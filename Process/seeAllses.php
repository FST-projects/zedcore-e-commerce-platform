<?php

session_start();


$sTerm = $_POST["s"];
$min = $_POST["min"];
$max = $_POST["max"];
$cat2 = $_POST["c2"];
$cat = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$clr = $_POST["clr"];
$condi = $_POST["condi"];
$sort = $_POST["sort"];


$array["sterm"] = $sTerm;
$array["min"] = $min;
$array["max"] = $max;
$array["cat2"] = $cat2;
$array["cat"] = $cat;
$array["brand"] = $brand;
$array["model"] = $model;
$array["clr"] = $clr;
$array["condi"] = $condi;
$array["sort"] = $sort;


$_SESSION["search"] = $array;  //save search to session for use in other pages.

echo ("success");
