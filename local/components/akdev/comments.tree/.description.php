<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("Древовидные комментарии"),
    "DESCRIPTION" => GetMessage("Комментарии к любой странице"),
    "PATH" => array(
        "ID" => "akdev_components",
        "CHILD" => array(
            "ID" => "com_tree",
            "NAME" => "Древовидные комментарии"
        )
    ),
    "ICON" => "images/comments-tree.png",
);

