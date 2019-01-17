<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */


$arFilter = array(
    'ACTIVE' => 'Y',
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'GLOBAL_ACTIVE'=>'Y',
    'PROPERTY_LINK_VALUE' => $arResult['CUR_PAGE']
);
/*$arSelect = array('IBLOCK_ID','ID','NAME','DEPTH_LEVEL',$arResult["ITEMS"]["ID"]['PROPERTIES']['PARENT_COMMENT']['ID']);
$arOrder = array('TIMESTAMP_X'=>'ASC','SORT'=>'ASC');
$rsItems = CIBlockElements::GetList($arOrder, $arFilter, false, $arSelect);
$itemLinc = array();
$arResult['ROOT'] = array();
$itemLinc[0] = &$arResult['ROOT'];
while($arItem = $rsItems->GetNext()) {
    $itemLinc[intval($arItem['IBLOCK_SECTION_ID'])]['CHILD'][$arItem['ID']] = $arItem;
    $itemLinc[$arItem['ID']] = &$itemLinc[intval($arItem['PROPERTIES']['PARENT_COMMENT']['ID'])]['CHILD'][$arItem['ID']];
}
unset($itemLinc);
echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($arFilter, true) . '</pre>';*/

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	// TODO: Подставить шаблон из параметра
	//$arParams['LIST_TEMPLATE'],
    "comments_tree",
	Array(
        "ACTIVE_DATE_FORMAT" => "d.m.y G:i",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "comments",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "LINK",
            1 => "",
        ),
        "SORT_BY1" => "TIMESTAMP_X",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "comments_tree",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "DETAIL_URL" => "",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_DESCRIPTION" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N"
	),
    $component
);
$APPLICATION->IncludeComponent(
    "bitrix:iblock.element.add.form",
    // TODO: Подставить шаблон из параметра
    //$arParams['ADD_FORM_TEMPLATE'],
    "add_comments",
    Array(
        "CUSTOM_TITLE_NAME" => "Имя",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "Комментарий",
        "DEFAULT_INPUT_SIZE" => "30",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "ELEMENT_ASSOC" => "CREATED_BY",
        "ELEMENT_ASSOC_PROPERTY" => "",
        "GROUPS" => array(
            0 => "2",
        ),
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "comments",
        "LEVEL_LAST" => "Y",
        "LIST_URL" => "",
        "MAX_FILE_SIZE" => "0",
        "MAX_LEVELS" => "100000",
        "MAX_USER_ENTRIES" => "100000",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "Y",
        "PROPERTY_CODES" => array(
            0 => "1",
            1 => "NAME",
            2 => "DATE_ACTIVE_FROM",
            3 => "PREVIEW_TEXT",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
            0 => "NAME",
            1 => "PREVIEW_TEXT",
        ),
        "RESIZE_IMAGES" => "N",
        "SEF_MODE" => "N",
        "STATUS" => "ANY",
        "STATUS_NEW" => "N",
        "USER_MESSAGE_ADD" => "Комментарий успешно добавлен",
        "USER_MESSAGE_EDIT" => "",
        "USE_CAPTCHA" => "Y",
        "COMPONENT_TEMPLATE" => "add_comments",
        "CUSTOM_TITLE_TAGS" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
        "CUR_PAGE" => $arResult['CUR_PAGE'],
    ),
    $component
);
