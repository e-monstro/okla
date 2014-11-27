<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"]) > 0) {
    LocalRedirect($backurl);
}

$APPLICATION->SetTitle("Регистрация");
?>
<?
if ($USER->IsAuthorized()):
    ?>
    <h1>Спасибо</h1>
    <p class="h4 st-thank">
        Все данные будут храниться в <a href="/personal/">личном кабинете</a>.
        Вы всегда с легкостью можете их изменить
    </p>
<? else: ?>
    <?$APPLICATION->IncludeComponent("bitrix:main.register", "steps-reg", Array(
	"SHOW_FIELDS" => array(	// Поля, которые показывать в форме
			0 => "EMAIL",
			1 => "NAME",
			2 => "LAST_NAME",
		),
		"REQUIRED_FIELDS" => array(	// Поля, обязательные для заполнения
			0 => "EMAIL",
		),
		"AUTH" => "Y",	// Автоматически авторизовать пользователей
		"USE_BACKURL" => "Y",	// Отправлять пользователя по обратной ссылке, если она есть
		"SUCCESS_PAGE" => "/register/success.php",	// Страница окончания регистрации
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"USER_PROPERTY" => "",	// Показывать доп. свойства
		"USER_PROPERTY_NAME" => "",	// Название блока пользовательских свойств,
            'USE_CAPTCHA'=>'N'
	),
	false
);?>
<?endif; ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>