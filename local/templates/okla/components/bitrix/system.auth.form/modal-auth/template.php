<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<div id="popid2" class="st-fbox-wrap">
    <h4>Вход в личный кабинет</h4>
    <? if ($arResult["FORM_TYPE"] == "login"): ?>

        <?
        if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) {
            ShowMessage($arResult['ERROR_MESSAGE']);
        }
        ?>

        <form name="system_auth_form<?= $arResult["RND"] ?>" method="post" class="ajax_form" target="_top"
              action="<?= $arResult["AUTH_URL"] ?>">
            <? if ($arResult["BACKURL"] <> ''): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <? endif ?>
            <? foreach ($arResult["POST"] as $key => $value): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
            <? endforeach ?>
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="AUTH"/>

            <div class="form-row">
                <input type="text" name="USER_LOGIN" maxlength="50" placeholder="Логин" class="form-contoller"
                       value="<?= $arResult["USER_LOGIN"] ?>" size="17"/>
            </div>
            <div class="form-row">
                <input type="password" name="USER_PASSWORD" placeholder="Пароль" class="form-contoller" maxlength="50"
                       size="17"/>
            </div>

            <? if ($arResult["SECURE_AUTH"]): ?>
                <span class="bx-auth-secure" id="bx_auth_secure<?= $arResult["RND"] ?>"
                      title="<? echo GetMessage("AUTH_SECURE_NOTE") ?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
                <noscript>
				<span class="bx-auth-secure" title="<? echo GetMessage("AUTH_NONSECURE_NOTE") ?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
                </script>
            <? endif ?>
            <? if ($arResult["STORE_PASSWORD"] == "Y" && false): ?>
                <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y"/>
                <label for="USER_REMEMBER_frm" title="<?= GetMessage("AUTH_REMEMBER_ME") ?>"><? echo GetMessage(
                        "AUTH_REMEMBER_SHORT"
                    ) ?></label>
            <? endif ?>
            <? if ($arResult["CAPTCHA_CODE"]): ?>
                <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>:<br/>
                <input type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>" width="180"
                     height="40" alt="CAPTCHA"/><br/><br/>
                <input type="text" name="captcha_word" maxlength="50" value=""/>
            <? endif ?>
            <div class="form-row cf">
                <input type="submit" name="Login" value="<?= GetMessage("AUTH_LOGIN_BUTTON") ?>" class="btn-red fleft"/>
                <a href="/register/" class="btn-green fright">Зарегистрироваться</a>
            </div>

            <noindex><a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>" rel="nofollow" class="fbox fancybox.ajax"
                        data-fancybox-type="ajax">Забыли пароль?
                    </a></noindex>
            <? if ($arResult["AUTH_SERVICES"]): ?>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:socserv.auth.form",
                    "icons",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "SUFFIX" => "form",
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                ?>
            <? endif ?>
        </form>

        <? if ($arResult["AUTH_SERVICES"]): ?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:socserv.auth.form",
                "",
                array(
                    "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                    "AUTH_URL" => $arResult["AUTH_URL"],
                    "POST" => $arResult["POST"],
                    "POPUP" => "Y",
                    "SUFFIX" => "form",
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
            ?>
        <? endif ?>

    <?
//if($arResult["FORM_TYPE"] == "login")
    else:
        ?>
        <p class="succeed">Вы успешно авторизовались под логином <b><?=$arResult['USER_LOGIN']?></b></p>
        <script>
            setTimeout(function(){
                location.reload();
            }, 2000)
        </script>
    <?endif ?>
</div>