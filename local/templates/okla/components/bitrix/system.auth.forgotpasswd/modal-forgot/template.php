<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<div id="popid1" class="st-fbox-wrap">
    <h4>Восстановление пароля</h4>
    <?

    ShowMessage($arParams["~AUTH_RESULT"]);

    ?>
    <form name="bform" method="post" target="_top" class="ajax_form" action="<?= $arResult["AUTH_URL"] ?>">
        <?
        if (strlen($arResult["BACKURL"]) > 0) {
            ?>
            <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
        <?
        }
        ?>
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="SEND_PWD">

        <div class="form-row">
            <input type="text" name="USER_LOGIN" placeholder="Логин" class="form-contoller" maxlength="50"
                   value="<?= $arResult["LAST_LOGIN"] ?>"/>
        </div>
        <div class="form-row" style="text-align: center">
            или
        </div>
        <div class="form-row">
            <input type="text" name="USER_EMAIL" placeholder="E-Mail" class="form-contoller" maxlength="255"/>
        </div>
        <div class="form-row">
            <input type="submit" name="send_account_info" class="btn-red btn-blk"
                   value="<?= GetMessage("AUTH_SEND") ?>"/>
        </div>
        <noindex><a href="/local/ajax/auth.php" rel="nofollow" class="fbox fancybox.ajax"
                    data-fancybox-type="ajax">Авторизация
            </a></noindex>
    </form>

</div>
