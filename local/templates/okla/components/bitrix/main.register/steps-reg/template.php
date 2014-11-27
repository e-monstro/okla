<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" enctype="multipart/form-data">
    <div class="reg-form-step step--1">
        <h1>Регистрация. Шаг 1</h1>

        <div class="st-form-wrapper">
            <?
            if (count($arResult["ERRORS"]) > 0):
                foreach ($arResult["ERRORS"] as $key => $error) {
                    if (intval($key) == 0 && $key !== 0) {
                        $arResult["ERRORS"][$key] = str_replace(
                            "#FIELD_NAME#",
                            "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;",
                            $error
                        );
                    }
                }

                ShowError(implode("<br />", $arResult["ERRORS"]));

            elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
                ?>
                <p><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></p>
            <?endif ?>


            <?
            if ($arResult["BACKURL"] <> ''):
                ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <?
            endif;
            ?>
            <div class="errors">
                <div class="login-error">Пользователь с таким логином уже зарегистрирован.</div>
                <div class="email-error">Пользователь с таким email-ом уже зарегистрирован.</div>
            </div>

            <div class="form-row">
                <input placeholder="Логин" class="form-contoller required reg-login" type="text" name="REGISTER[LOGIN]"
                       required=""
                       value="<?= $_REQUEST['REGISTER']['LOGIN'] ?>"/>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Пароль" class="form-contoller required reg-pass" name="REGISTER[PASSWORD]"
                           type="password"
                           required=""/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Подтвердите пароль" class="form-contoller required reg-pass-conf"
                           name="REGISTER[CONFIRM_PASSWORD]"
                           type="password" required=""/>
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Имя" class="form-contoller" type="text" name="REGISTER[NAME]"
                           value="<?= $_REQUEST['REGISTER']['NAME'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Фамилия" class="form-contoller" type="text" name="REGISTER[LAST_NAME]"
                           value="<?= $_REQUEST['REGISTER']['LAST_NAME'] ?>"/>
                </div>
            </div>
            <div class="form-row">
                <input placeholder="E-mail" class="form-contoller required reg-email" type="text" name="REGISTER[EMAIL]"
                       required=""/>
            </div>
            <div class="form-row">
                <input class="btn-red reg_next_step" onclick="processRegStep($(this).closest('form'), 2)" type="button"
                       name="name" value="Далее"/>
            </div>

        </div>
    </div>

    <div class="reg-form-step step--2">
        <h1>Регистрация. Шаг 2</h1>

        <div class="st-form-wrapper">
            <div class="form-row">
                <input placeholder="Номер телефона (Для оповещения о статусе заказа)" class="form-contoller" type="text"
                       name="REGISTER[PERSONAL_PHONE]" value="<?= $_REQUEST['REGISTER']['PERSONAL_PHONE'] ?>"/>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Город" class="form-contoller" type="text" name="REGISTER[PERSONAL_CITY]"
                           value="<?= $_REQUEST['REGISTER']['PERSONAL_CITY'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Улица" class="form-contoller" type="text" name="REGISTER[PERSONAL_STREET]"
                           value="<?= $_REQUEST['REGISTER']['PERSONAL_STREET'] ?>"/>
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Дом/корпус" class="form-contoller" type="text" name="REGISTER[UF_HOUSE]"
                           value="<?= $_REQUEST['REGISTER']['UF_HOUSE'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Квартира" class="form-contoller" type="text" name="REGISTER[UF_ROOM]"
                           value="<?= $_REQUEST['REGISTER']['UF_ROOM'] ?>"/>
                </div>
            </div>
            <div class="form-row">
                <input placeholder="Дата рождения (Для получения спец. предложений)" class="form-contoller" type="text"
                       name="REGISTER[PERSONAL_BIRTHDAY]" value="<?= $_REQUEST['REGISTER']['PERSONAL_BIRTHDAY'] ?>"/>
            </div>
            <div class="form-row">
                <input class="btn-red reg_next_step" type="button" onclick="processRegStep($(this).closest('form'), 3)"
                       name="name" value="Далее"/>
            </div>
        </div>
    </div>

    <div class="reg-form-step step--3">
        <h1>Регистрация. Шаг 3</h1>
        <h4>Мои параметры</h4>

        <div class="st-form-wrapper">
                <div class="form-row">
                    <input placeholder="Рост (см)" class="form-contoller" type="text" name="REGISTER[UF_HGT]" value="<?= $_REQUEST['REGISTER']['UF_HGT'] ?>"/>
                </div>
                <div class="form-row cf">
                    <div class="fleft form-col-half">
                        <input placeholder="Обхват груди" class="form-contoller" type="text" name="REGISTER[UF_CHEST]" value="<?= $_REQUEST['REGISTER']['UF_CHEST'] ?>"/>
                    </div>
                    <div class="fright form-col-half">
                        <input placeholder="Обхват талии" class="form-contoller" type="text" name="REGISTER[UF_TAL]" value="<?= $_REQUEST['REGISTER']['UF_TAL'] ?>"/>
                    </div>
                </div>
                <div class="form-row cf">
                    <div class="fleft form-col-half">
                        <input placeholder="Обхват бедер" class="form-contoller" type="text" name="REGISTER[UF_BEDR]" value="<?= $_REQUEST['REGISTER']['UF_BEDR'] ?>"/>
                    </div>
                    <div class="fright form-col-half">
                        <input placeholder="Размер обуви (см)" class="form-contoller" type="text" name="REGISTER[UF_FOOT]" value="<?= $_REQUEST['REGISTER']['UF_FOOT'] ?>"/>
                    </div>
                </div>
                <div class="form-row">
                    <input class="btn-red" type="submit" name="register_submit_button" value="Завершить"/>
                </div>
        </div>
    </div>
</form>