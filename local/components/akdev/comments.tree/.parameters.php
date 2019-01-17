<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule("iblock");

// типы инфоблоков
$arIBlockType = CIBlockParameters::GetIBlockTypes();

// инфоблоки выбранного типа
$arIBlock = [];
$iblockFilter = !empty($arCurrentValues['IBLOCK_TYPE'])
    ? ['TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y']
    : ['ACTIVE' => 'Y'];

$rsIBlock = CIBlock::GetList(['SORT' => 'ASC'], $iblockFilter);
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
}
unset($arr, $rsIBlock, $iblockFilter);

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "LIST_TEMPLATE" => array(
            "PARENT" => "BASE",
            "NAME" => "Шаблон для списка комментариев",
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "DEFAULT" => "",
            "REFRESH" => "N",
            "VALUE" => "", //TODO Подключить определение списка шаблонов вложенного компонента news.list
        ),
        "IBLOCK_TYPE" => [
            "PARENT" => "SETTINGS",
            "NAME" => "Тип инфоблока",//Loc::getMessage('EXAMPLE_COMPSIMPLE_PROP_IBLOCK_TYPE'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y"
        ],
        "IBLOCK_ID" => [
            "PARENT" => "SETTINGS",
            "NAME" => "Инфоблок",//Loc::getMessage('EXAMPLE_COMPSIMPLE_PROP_IBLOCK_ID'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y"
        ],
        "CACHE_TIME" => ['DEFAULT' => 3600],
    ),
);