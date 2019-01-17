<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Демонстрация компонента древовидных комментариев");
?>

<?$APPLICATION->IncludeComponent(
	"akdev:comments.tree",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"LIST_TEMPLATE" => "",
		"IBLOCK_TYPE" => "comments",
		"IBLOCK_ID" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>