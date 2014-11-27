<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<? ShowError($arResult["strProfileError"]); ?>
<?
if ($arResult['DATA_SAVED'] == 'Y') {
    ShowNote(GetMessage('PROFILE_DATA_SAVED'));
}
?>
<form method="post" name="form1" action="<?= $arResult["FORM_TARGET"] ?>" enctype="multipart/form-data">
    <?= $arResult["BX_SESSION_CHECK"] ?>
    <input type="hidden" name="lang" value="<?= LANG ?>"/>
    <input type="hidden" name="ID" value=<?= $arResult["ID"] ?>/>

    <div class="cf form-line">
        <div class="st-form-wrapper fleft">
            <div class="h4">
                Мои данные:
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Логин" class="form-contoller" type="text" name="LOGIN"
                           value="<?= $arResult['arUser']['LOGIN'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="E-mail" class="form-contoller" type="text" name="EMAIL"
                           value="<?= $arResult['arUser']['EMAIL'] ?>"/>
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Имя" class="form-contoller" type="text" name="NAME"
                           value="<?= $arResult['arUser']['NAME'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Фамилия" class="form-contoller" type="text" name="LAST_NAME"
                           value="<?= $arResult['arUser']['LAST_NAME'] ?>"/>
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input placeholder="Дата рождения" class="form-contoller" type="text" name="PERSONAL_BIRTHDAY"
                           value="<?= $arResult['arUser']['PERSONAL_BIRTHDAY'] ?>"/>
                </div>
                <div class="fright form-col-half">
                    <input placeholder="Мужской" class="form-contoller" type="text" name="name"/>
                </div>
            </div>
            <div class="form-row">
                <input placeholder="Номер телефона" class="form-contoller" type="text" name="PERSONAL_PHONE"
                       value="<?= $arResult['arUser']['PERSONAL_PHONE'] ?>"/>
            </div>

        </div>
        <div class="st-form-wrapper fright">
            <div class="h4">
                Мой адрес:
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input type="text" class="form-contoller" placeholder="Город" name="PERSONAL_CITY"
                           value="<?= $arResult['arUser']['PERSONAL_CITY'] ?>">
                </div>
                <div class="fright form-col-half">
                    <input type="text" class="form-contoller" placeholder="Улица" name="PERSONAL_STREET"
                           value="<?= $arResult['arUser']['PERSONAL_STREET'] ?>">
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input type="text" class="form-contoller" placeholder="Дом/корпус" name="UF_HOUSE"
                           value="<?= $arResult['arUser']['UF_HOUSE'] ?>">
                </div>
                <div class="fright form-col-half">
                    <input type="text" class="form-contoller" placeholder="Квартира" name="UF_ROOM"
                           value="<?= $arResult['arUser']['UF_ROOM'] ?>">
                </div>
            </div>

        </div>
    </div>
    <div class="cf form-line">
        <div class="h4">
            Мои параметры
        </div>
        <div class="st-form-wrapper fleft">
            <div class="form-row">
                <input type="text" class="form-contoller" placeholder="Рост (см)" name="UF_HGT"
                       value="<?= $arResult['arUser']['UF_HGT'] ?>">
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input type="text" class="form-contoller" placeholder="Обхват груди"
                           name="UF_CHEST" value="<?= $arResult['arUser']['UF_CHEST'] ?>">
                </div>
                <div class="fright form-col-half">
                    <input type="text" class="form-contoller" placeholder="Обхват талии" name="UF_TAL"
                           value="<?= $arResult['arUser']['UF_TAL'] ?>">
                </div>
            </div>
            <div class="form-row cf">
                <div class="fleft form-col-half">
                    <input type="text" class="form-contoller" placeholder="Обхват бедер" name="UF_BEDR"
                           value="<?= $arResult['arUser']['UF_BEDR'] ?>">
                </div>
                <div class="fright form-col-half">
                    <input type="text" class="form-contoller" placeholder="Размер обуви (см)" name="UF_FOOT"
                           value="<?= $arResult['arUser']['UF_FOOT'] ?>">
                </div>
            </div>
            <div class="form-row">
                <input type="submit" name="save" class="btn-red"
                       value="<?= (($arResult["ID"] > 0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD")) ?>">
            </div>
        </div>
        <div class="st-form-wrapper fright">
            <? $APPLICATION->IncludeFile(
                "/local/include_areas/personal_banner.php",
                Array(),
                Array("MODE" => "html")
            ); ?>
        </div>
    </div>
    <div class="cf form-line">
        <div class="st-form-wrapper fleft">
            <a class="my-cart-link red-btn-big d-blk" href="/personal/cart/"><img src="/local/markup/img/cart2.png"/>
                Моя корзина</a>
        </div>
        <div class="st-form-wrapper fright">
            <a class="my-wish-link green-btn-big d-blk" href="/personal/wishlist/"><img
                    src="/local/markup/img/heart.png"/> Список желаний</a>
        </div>
    </div>

    <!--<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>-->


</form>