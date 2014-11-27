<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
?>
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "okla-personal", Array(
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"USER_PROPERTY" => array(	// Показывать доп. свойства
			0 => "UF_HOUSE",
			1 => "UF_ROOM",
			2 => "UF_HGT",
			3 => "UF_CHEST",
			4 => "UF_TAL",
			5 => "UF_BEDR",
			6 => "UF_FOOT",
		),
		"SEND_INFO" => "N",	// Генерировать почтовое событие
		"CHECK_RIGHTS" => "N",	// Проверять права доступа
		"USER_PROPERTY_NAME" => "",	// Название закладки с доп. свойствами
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
