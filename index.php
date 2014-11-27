<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
?>
    <h2>НОВОЕ ПОСТУПЛЕНИЕ</h2>
<?$APPLICATION->IncludeComponent(
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
        "PAGE_ELEMENT_COUNT" => "8",
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
    <div class="st-carousel-wrap">
        <?
            global $arrBrandsFilter;
            $arrBrandsFilter['!PREVIEW_PICTURE'] = false;
        ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "brands-main",
            Array(
                "IBLOCK_TYPE" => "services",
                "IBLOCK_ID" => "8",
                "NEWS_COUNT" => "1000",
                "SORT_BY1" => "NAME",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "",
                "SORT_ORDER2" => "",
                "FILTER_NAME" => "arrBrandsFilter",
                "FIELD_CODE" => array("ID", "NAME", "SORT", "PREVIEW_PICTURE", ""),
                "PROPERTY_CODE" => array("", ""),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "PAGER_TEMPLATE" => "",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N"
            )
        );?>
    </div>

    <?
    $helper = new MainHelper();
    $unoBanner = $helper->getPosBanner(1);
    $dueBanner = $helper->getPosBanner(2);
    $trioBanner = $helper->getPosBanner(3);

    if($unoBanner || $dueBanner || $trioBanner):
    ?>
        <div class="cf st-banners-block">
            <?if($unoBanner):?>
                <div class="fleft st-banner-left-block">
                    <?if($unoBanner['PROPERTY_LINK_VALUE']):?>
                        <a href="<?=$unoBanner['PROPERTY_LINK_VALUE']?>" class="banner_hover">
                            <img src="<?=CFile::GetPath($unoBanner['PREVIEW_PICTURE'])?>" />
                        </a>
                    <?else:?>
                        <img src="<?=CFile::GetPath($unoBanner['PREVIEW_PICTURE'])?>" />
                    <?endif;?>

                </div>
            <?endif;?>

            <div class="fright st-banner-right-block">
                <?if($dueBanner):?>
                    <div class="banner-sml-toprow">
                        <?if($dueBanner['PROPERTY_LINK_VALUE']):?>
                            <a href="<?=$dueBanner['PROPERTY_LINK_VALUE']?>" class="banner_hover">
                                <img src="<?=CFile::GetPath($dueBanner['PREVIEW_PICTURE'])?>" />
                            </a>
                        <?else:?>
                            <img src="<?=CFile::GetPath($dueBanner['PREVIEW_PICTURE'])?>" />
                        <?endif;?>
                    </div>
                <?endif;?>

                <?if($trioBanner):?>
                    <div class="st-banner-right-block">
                        <?if($trioBanner['PROPERTY_LINK_VALUE']):?>
                            <a href="<?=$trioBanner['PROPERTY_LINK_VALUE']?>" class="banner_hover">
                                <img src="<?=CFile::GetPath($trioBanner['PREVIEW_PICTURE'])?>" />
                            </a>
                        <?else:?>
                            <img src="<?=CFile::GetPath($trioBanner['PREVIEW_PICTURE'])?>" />
                        <?endif;?>
                    </div>
                <?endif;?>

            </div>
        </div>
    <?endif;?>

    <div class="h2">
        МЫ В INSTAGRAM
    </div>
    <ul class="list-unstyled st-instalist cf" id="instafeed"></ul>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>