<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['DATE'] = date('Y-m-d');
$arResult['CUR_PAGE'] = $APPLICATION->GetCurPage();
$this->IncludeComponentTemplate();

