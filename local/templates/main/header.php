<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <? \Bitrix\Main\Page\Asset::getInstance()->addCss('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'); ?>
    <? \Bitrix\Main\Page\Asset::getInstance()->addCss('https://use.fontawesome.com/releases/v5.6.3/css/all.css'); ?>
    <? \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/custom.css'); ?>

    <? \Bitrix\Main\Page\Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.3.1.slim.min.js'); ?>
    <? \Bitrix\Main\Page\Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'); ?>
    <? \Bitrix\Main\Page\Asset::getInstance()->addJs('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'); ?>
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header>
    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "grey_tabs",
        array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "left",
            "USE_EXT" => "N",
            "COMPONENT_TEMPLATE" => "grey_tabs",
            "MENU_THEME" => "site"
        ),
        false
    ); ?>
</header>
<hr>
<main>
    <div class="container-fluid">
        <h1><? $APPLICATION->ShowTitle() ?></h1>


