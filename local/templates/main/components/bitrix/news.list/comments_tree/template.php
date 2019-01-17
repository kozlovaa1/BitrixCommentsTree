<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
foreach ($arResult["ITEMS"] as $key => $arItem) {

    if ($arItem['PROPERTIES']['PARENT_COMMENT'] > 0) {
        $parent_id = $arItem['PROPERTIES']['PARENT_COMMENT']['VALUE'];
        foreach ($arResult["ITEMS"] as $arParentItem) {
            if ($arParentItem['ID'] == $parent_id) {
                $map_items['' . $parent_id]['ID'] = $parent_id;
                $map_items['' . $parent_id]['NAME'] = $arParentItem['NAME'];
                $map_items['' . $parent_id]['TIMESTAMP_X'] = $arParentItem['TIMESTAMP_X'];
                $map_items['' . $parent_id]['PREVIEW_TEXT'] = $arParentItem['PREVIEW_TEXT'];
                //$map_items['' . $parent_id]['EDIT_LINK'] = $arParentItem['EDIT_LINK'];
                //$map_items['' . $parent_id]['DELETE_LINK'] = $arParentItem['DELETE_LINK'];
                //$map_items['' . $parent_id]['IBLOCK_ID'] = $arParentItem['IBLOCK_ID'];
                $map_items['' . $parent_id]['CHILDREN'][] = array(
                    "ID" => $arItem['ID'],
                    "NAME" => $arItem['NAME'],
                    "TIMESTAMP_X" => $arItem['TIMESTAMP_X'],
                    "PREVIEW_TEXT" => $arItem['PREVIEW_TEXT'],
                    "PARENT_ID" => $arItem['PROPERTIES']['PARENT_COMMENT']['VALUE'],
                    //"EDIT_LINK" => $arItem['EDIT_LINK'],
                    //"DELETE_LINK" => $arItem['DELETE_LINK'],
                    //"IBLOCK_ID" => $arItem['IBLOCK_ID'],
                );
            }
        }


    }

}

$arResult['MAP'] = $map_items;
?>
<div class="comments">
    <?

    /**
     * Обход массива с рекурсией для построения дерева комментариев
     *
     * @param array $arItems Подготовленный массив комментариев
     *
     * @param boolean $childrenFlag Показатель вложенности комментария
     */
    function outTree($arItems, $childrenFlag)
    {
        echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($childrenFlag, true) . '</pre>';
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
                    ?>
                    <div class="media <? $childrenFlag == true ? 'mt-3' : ''; ?>" id="<?//= $this->GetEditAreaId($arItem['ID']); ?>">
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
                    outTree($arItem['CHILDREN'], true);
                }
                ?>
                </div>
                </div>
                <?
            }
        }
    }

    outTree($arResult['MAP'], false);

    ?>

    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? } ?>
</div>
