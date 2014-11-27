<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>










<?
$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
    'ID' => $strMainID,
    'PICT' => $strMainID . '_pict',
    'DISCOUNT_PICT_ID' => $strMainID . '_dsc_pict',
    'STICKER_ID' => $strMainID . '_sticker',
    'BIG_SLIDER_ID' => $strMainID . '_big_slider',
    'BIG_IMG_CONT_ID' => $strMainID . '_bigimg_cont',
    'SLIDER_CONT_ID' => $strMainID . '_slider_cont',
    'SLIDER_LIST' => $strMainID . '_slider_list',
    'SLIDER_LEFT' => $strMainID . '_slider_left',
    'SLIDER_RIGHT' => $strMainID . '_slider_right',
    'OLD_PRICE' => $strMainID . '_old_price',
    'PRICE' => $strMainID . '_price',
    'DISCOUNT_PRICE' => $strMainID . '_price_discount',
    'SLIDER_CONT_OF_ID' => $strMainID . '_slider_cont_',
    'SLIDER_LIST_OF_ID' => $strMainID . '_slider_list_',
    'SLIDER_LEFT_OF_ID' => $strMainID . '_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID . '_slider_right_',
    'QUANTITY' => $strMainID . '_quantity',
    'QUANTITY_DOWN' => $strMainID . '_quant_down',
    'QUANTITY_UP' => $strMainID . '_quant_up',
    'QUANTITY_MEASURE' => $strMainID . '_quant_measure',
    'QUANTITY_LIMIT' => $strMainID . '_quant_limit',
    'BUY_LINK' => $strMainID . '_buy_link',
    'ADD_BASKET_LINK' => $strMainID . '_add_basket_link',
    'COMPARE_LINK' => $strMainID . '_compare_link',
    'PROP' => $strMainID . '_prop_',
    'PROP_DIV' => $strMainID . '_skudiv',
    'DISPLAY_PROP_DIV' => $strMainID . '_sku_prop',
    'OFFER_GROUP' => $strMainID . '_set_group_',
    'BASKET_PROP_DIV' => $strMainID . '_basket_prop',
);
$strObName = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;


?>
<div class="cf det-blocks-wrap bx_item_detail " id="<? echo $arItemIDs['ID']; ?>">
    <? if (count($arResult["MORE_PHOTO"]) > 0): ?>
        <div class="product-carousel-wrapper fleft">
            <div class="vert-car-wrap fleft">
                <a href="#" class="fred-prev3"></a>
                <ul class="list-unstyled vert-cart js-frd-vert">
                    <? foreach ($arResult["MORE_PHOTO"] as $k => $photo): ?>
                        <li>
                            <a class="caroufredsel" href="#b<?= $k ?>"><img
                                    src="<?= MainHelper::iResize($photo["ID"], 80, 100) ?>"/></a>
                        </li>
                    <? endforeach; ?>
                </ul>
                <a href="#" class="fred-next3"></a>
            </div>
            <div class="carous-container fright">
                <ul class="list-unstyled vert-cart-main js-vert-main">
                    <? foreach ($arResult["MORE_PHOTO"] as $k => $photo): ?>
                        <li class="sliderkit-panel" id="b<?= $k ?>">
                            <a rel="gallery1" href="<?= $photo["SRC"] ?>"><img
                                    src="<?= MainHelper::iResize($photo["ID"], 400, 490) ?>"/></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    <? endif; ?>

    <div class="product-info fright">
        <h1><?= $arResult["NAME"] ?></h1>

        <div class="prices-block">
            <?
            $boolDiscountShow = (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']);
            ?>
            <span class="st-price"
                  id="<? echo $arItemIDs['PRICE']; ?>"><? echo $arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']; ?></span>
            <span class="st-old-price" id="<? echo $arItemIDs['OLD_PRICE']; ?>"
                  style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow ? $arResult['MIN_PRICE']['PRINT_VALUE'] : ''); ?></span>
        </div>
        <?
        if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
            ?>
            <div>
                <?
                if (!empty($arResult['DISPLAY_PROPERTIES']))
                {
                ?>
                <ul class="list-unstyled props-list">
                    <?
                    foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp)
                    {
                    ?>
                    <li><? echo $arOneProp['NAME']; ?>: <?
                        echo '<span class="red-lab">', (
                        is_array($arOneProp['DISPLAY_VALUE'])
                            ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                            : $arOneProp['DISPLAY_VALUE']
                        ), '</span>';
                        }
                        unset($arOneProp);
                        ?>
                    </li>
                    <?
                    }
                    ?>
            </div>
        <?
        }?>
        <?
        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP'])) {
            $arSkuProps = array();
            ?>
            <div class="item_info_section" style="padding-right:150px;" id="<? echo $arItemIDs['PROP_DIV']; ?>">
                <?
                foreach ($arResult['SKU_PROPS'] as $kk => &$arProp) {
                    //echo "<pre>";print_r($arProp['VALUES']);echo"</pre>";
                    if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']])) {
                        continue;
                    }
                    $arSkuProps[] = array(
                        'ID' => $arProp['ID'],
                        'SHOW_MODE' => $arProp['SHOW_MODE'],
                        'VALUES_COUNT' => $arProp['VALUES_COUNT']
                    );
                    if ('TEXT' == $arProp['SHOW_MODE']) {
                        if (5 < $arProp['VALUES_COUNT']) {
                            $strClass = 'bx_item_detail_size full';
                            $strOneWidth = (100 / $arProp['VALUES_COUNT']) . '%';
                            $strWidth = (20 * $arProp['VALUES_COUNT']) . '%';
                            $strSlideStyle = '';
                        } else {
                            $strClass = 'bx_item_detail_size';
                            $strOneWidth = '20%';
                            $strWidth = '100%';
                            $strSlideStyle = 'display: none;';
                        }
                        ?>
                        <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_cont">
                            <? if ($kk == "COLOR"): $class = 'colors-list cf list-unstyled det-colors' ?>
                                <div class="det-title">Выберите цвет:</div>
                            <? elseif ($kk == "SIZE"): $class = 'list-unstyled sidebar-prod-sizes cf det-sizes' ?>
                                <div class="det-title">Размеры:</div>
                            <?
                            else: ?>
                                <div class="det-title"><? echo htmlspecialcharsex($arProp['NAME']); ?></div>
                            <? endif; ?>
                            <div class="bx_size_scroller_container">
                                <div class="bx_size">
                                    <ul class='<?= $class ?>' id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_list"
                                        style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                        <?
                                        if ($kk == "COLOR"):
                                            foreach ($arProp['VALUES'] as $arOneValue) {
                                                $cc = MainHelper::GetColor($arOneValue['NAME']);

                                                ?>
                                                <li
                                                    data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                                    data-onevalue="<? echo $arOneValue['ID']; ?>"
                                                    style="width: <? echo $strOneWidth; ?>; height:40px; display: none;"
                                                    class=''
                                                    ><span class="cnt" style='height:40px;'
                                                           title='<?= $cc["NAME"] ?>'><img width='100%' height='100%'
                                                                                           src='<?= $cc["PIC"] ?>'/></span>
                                                </li>
                                            <?
                                            }
                                        else:
                                            foreach ($arProp['VALUES'] as $arOneValue) {
                                                ?>
                                                <li
                                                    data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                                    data-onevalue="<? echo $arOneValue['ID']; ?>"
                                                    style="width: <? echo $strOneWidth; ?>; display: none;"
                                                    ><span class="cnt"><? echo htmlspecialcharsex(
                                                            $arOneValue['NAME']
                                                        ); ?></span></li>
                                            <?
                                            }

                                        endif;
                                        ?>
                                    </ul>
                                </div>
                                <div class="bx_slide_left" style="<? echo $strSlideStyle; ?>"
                                     id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_left"
                                     data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                <div class="bx_slide_right" style="<? echo $strSlideStyle; ?>"
                                     id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_right"
                                     data-treevalue="<? echo $arProp['ID']; ?>"></div>
                            </div>
                        </div>
                    <?
                    }
                }
                unset($arProp);
                ?>
            </div>
        <?
        }
        ?>
        <div class="cust-link-wrp">
            <a href="/about/sizes.php" target='_blank'>Таблица размеров</a>
        </div>

        <a href="javascript:void(0)" id="<? echo $arItemIDs['BUY_LINK']; ?>" class="red-btn-sm">В корзину</a>
        <a class="transparent-btn-sm" href="#"><img src="/local/markup/img/heart2.png"/> В желания</a>
    </div>
</div>


<?
if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
    foreach ($arResult['JS_OFFERS'] as &$arOneJS) {
        if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE']) {
            $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'] = GetMessage(
                'ECONOMY_INFO',
                array('#ECONOMY#' => $arOneJS['PRICE']['PRINT_DISCOUNT_DIFF'])
            );
            $arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
        $strProps = '';
        if ($arResult['SHOW_OFFERS_PROPS']) {
            if (!empty($arOneJS['DISPLAY_PROPERTIES'])) {
                foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp) {
                    $strProps .= '<dt>' . $arOneProp['NAME'] . '</dt><dd>' . (
                        is_array($arOneProp['VALUE'])
                            ? implode(' / ', $arOneProp['VALUE'])
                            : $arOneProp['VALUE']
                        ) . '</dd>';
                }
            }
        }
        $arOneJS['DISPLAY_PROPERTIES'] = $strProps;
    }
    if (isset($arOneJS))
        unset($arOneJS);
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
            'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
            'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
        ),
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'NAME' => $arResult['~NAME']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $arSkuProps
    );
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties) {
        ?>
        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
            <?
            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                    ?>
                    <input
                        type="hidden"
                        name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                        value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>"
                        >
                    <?
                    if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                }
            }
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {
                ?>
                <table>
                    <?
                    foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                        ?>
                        <tr>
                            <td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                            <td>
                                <?
                                if (
                                    'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                    && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                                ) {
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?><label><input
                                        type="radio"
                                        name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                        value="<? echo $valueID; ?>"
                                        <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>
                                        ><? echo $value; ?></label><br><?
                                    }
                                } else {
                                    ?><select
                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                    foreach ($propInfo['VALUES'] as $valueID => $value) {
                                        ?>
                                        <option
                                        value="<? echo $valueID; ?>"
                                        <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>
                                        ><? echo $value; ?></option><?
                                    }
                                    ?></select><?
                                }
                                ?>
                            </td>
                        </tr>
                    <?
                    }
                    ?>
                </table>
            <?
            }
            ?>
        </div>
    <?
    }
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array(
                        $arResult['MIN_PRICE']
                    )),
            'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
            'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
            'DISPLAY_COMPARE' => ('Y' == $arParams['DISPLAY_COMPARE']),
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE']
        ),
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'PICT' => $arFirstPhoto,
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'PRICE' => $arResult['MIN_PRICE'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
            'BUY_URL' => $arResult['~BUY_URL'],
        ),
        'BASKET' => array(
            'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL']
        )
    );
    unset($emptyProductProperties);
}
?>
<script type="text/javascript">
    var <? echo $strObName; ?> =
    new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
    BX.message({
        MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCE_CATALOG_BUY')); ?>',
        MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCE_CATALOG_ADD')); ?>',
        MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE')); ?>',
        TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
        TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
        BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
        BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
        BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE') ?>',
        SITE_ID: '<? echo SITE_ID; ?>'
    });
</script>


<h2>ВАМ МОЖЕТ ПОНРАВИТЬСЯ</h2>
<?
$GLOBALS["arrNewFilter"]["!SECTION_ID"] = $arResult["IBLOCK_SECTION_ID"];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "grid-products",
    array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "3",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "ELEMENT_SORT_FIELD" => "timestamp_x",
        "ELEMENT_SORT_ORDER" => "desc",
        "ELEMENT_SORT_FIELD2" => "",
        "ELEMENT_SORT_ORDER2" => "",
        "FILTER_NAME" => "arrNewFilter",
        "INCLUDE_SUBSECTIONS" => "Y",
        "SHOW_ALL_WO_SECTION" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "PAGE_ELEMENT_COUNT" => "4",
        "LINE_ELEMENT_COUNT" => "4",
        "PROPERTY_CODE" => array(
            0 => "MINIMUM_PRICE",
            1 => "MAXIMUM_PRICE",
            2 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "TEMPLATE_THEME" => "",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "N",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "",
        "SET_META_DESCRIPTION" => "N",
        "META_DESCRIPTION" => "",
        "BROWSER_TITLE" => "-",
        "ADD_SECTIONS_CHAIN" => "N",
        "DISPLAY_COMPARE" => "N",
        "SET_TITLE" => "N",
        "SET_STATUS_404" => "N",
        "CACHE_FILTER" => "N",
        "PRICE_CODE" => array(
            0 => "BASE",
            1 => "Розничные",
        ),
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "BASKET_URL" => "/personal/cart/",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "USE_PRODUCT_QUANTITY" => "N",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "PRODUCT_PROPERTIES" => array(
            0 => "SIZE",
            1 => "COLOR",
        ),
        "PAGER_TEMPLATE" => "",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Товары",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_PROPERTY_CODE" => array(
            0 => "SIZE",
            1 => "",
        ),
        "OFFERS_SORT_FIELD" => "",
        "OFFERS_SORT_ORDER" => "",
        "OFFERS_SORT_FIELD2" => "",
        "OFFERS_SORT_ORDER2" => "",
        "OFFERS_CART_PROPERTIES" => array(
            0 => "SIZE",
            1 => "COLOR",
        ),
        "AJAX_OPTION_ADDITIONAL" => "",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity"
    ),
    false
);?>
        
       




