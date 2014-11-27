<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php")?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "modal-auth", Array(
        "REGISTER_URL" => "/register/",	// Страница регистрации
        "FORGOT_PASSWORD_URL" => "/local/ajax/forgot.php",	// Страница забытого пароля
        "PROFILE_URL" => "/personal/",	// Страница профиля
        "SHOW_ERRORS" => "Y",	// Показывать ошибки
    ),
    false
);?>