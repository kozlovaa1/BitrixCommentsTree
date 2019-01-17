<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);

$map_items = array();
foreach ($arResult["ITEMS"] as $arItem) {

    if ($arItem['PROPERTIES']['PARENT_COMMENT'] > 0) {
        $parent_id = $arItem['PROPERTIES']['PARENT_COMMENT']['VALUE'];
        $map_items['' . $parent_id]['ID'] = $arResult["ITEMS"][$parent_id]['ID'];
        $map_items['' . $parent_id]['NAME'] = $arResult["ITEMS"][$parent_id]['NAME'];
        $map_items['' . $parent_id]['TIMESTAMP_X'] = $arResult["ITEMS"][$parent_id]['TIMESTAMP_X'];
        $map_items['' . $parent_id]['PREVIEW_TEXT'] = $arResult["ITEMS"][$parent_id]['PREVIEW_TEXT'];
        $map_items['' . $parent_id]['EDIT_LINK'] = $arResult["ITEMS"][$parent_id]['EDIT_LINK'];
        $map_items['' . $parent_id]['DELETE_LINK'] = $arResult["ITEMS"][$parent_id]['DELETE_LINK'];
        $map_items['' . $parent_id]['IBLOCK_ID'] = $arResult["ITEMS"][$parent_id]['IBLOCK_ID'];
        $map_items['' . $parent_id]['CHILDREN'][] = array(
            "ID" => $arItem['ID'],
            "NAME" => $arItem['NAME'],
            "TIMESTAMP_X" => $arItem['TIMESTAMP_X'],
            "PREVIEW_TEXT" => $arItem['PREVIEW_TEXT'],
            "PARENT_ID" => $arItem['PROPERTIES']['PARENT_COMMENT']['VALUE'],
            "EDIT_LINK" => $arItem['EDIT_LINK'],
            "DELETE_LINK" => $arItem['DELETE_LINK'],
            "IBLOCK_ID" => $arItem['IBLOCK_ID'],
        );
    }

}

$arResult['MAP'] = $map_items;
?>
<?echo'<pre>',print_r($arResult['MAP'], true),'</pre>'?>
<div class="comments">
    <?
    function outTree($arItems)
    {
        if (isset($arItems)) {
            foreach ($arItems as $arItem) {

                /*$this->AddEditAction(
                    $arItem['ID'],
                    $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID(
                        $arItem["IBLOCK_ID"],
                        "ELEMENT_EDIT"
                    )
                );
                $this->AddDeleteAction(
                    $arItem['ID'],
                    $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID(
                        $arItem["IBLOCK_ID"],
                        "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
                );*/

                if ($arItem['ID']) {
                    //echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>ID = ' . print_r($arItem['ID'], true) . '</pre>';
                    //echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>PARENT_ID = ' . print_r($arItem['PARENT_ID'], true) . '</pre>';?>
                    <div class="media" id="<?//= $this->GetEditAreaId($arItem['ID']); ?>">
                        <i class="fas fa-user-circle mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0"><?= $arItem['NAME'] ?></h5>
                            <? $value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arItem['TIMESTAMP_X'], CSite::GetDateFormat())); ?>
                            <p class="comment-date"><?= $value ?></p>
                            <p><?= $arItem['PREVIEW_TEXT'] ?></p>
                            <a class="btn btn-outline-primary reply-button" data-commentid="<?= $arItem['ID'] ?>" href="#">Ответить</a>
                            <?
                }
                if (count($arItem['CHILDREN']) > 0) {
                    //Рекурсивно вызываем эту же функцию, но с новым $parent_id
                    outTree($arItem['CHILDREN']);
                }
                if ($arItem['ID']) { ?>
                        </div>
                    </div>
                <?
                }
            }
        }
    }

    //outTree($arResult['MAP']);

    ?>

    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? } ?>
</div>
