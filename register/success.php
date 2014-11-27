<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"]) > 0) {
    LocalRedirect($backurl);
}

$APPLICATION->SetTitle("Регистрация");
?>
    <h1>Спасибо</h1>
    <p class="h4 st-thank">
        Все данные будут храниться в <a href="/personal/">личном кабинете</a>.
        Вы всегда с легкостью можете их изменить
    </p>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>