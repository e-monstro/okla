<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico">
    <title><?= $APPLICATION->ShowTitle(); ?></title>
    <link href="/local/markup/css/fancybox.css" rel="stylesheet">
    <link href="/local/markup/css/select2.css" rel="stylesheet">
    <link href="/local/markup/css/check.css" rel="stylesheet">
    <link href="/local/markup/css/jquery-ui.css" rel="stylesheet">
    <link href="/local/markup/css/scrollpane.css" rel="stylesheet">
    <link href="/local/markup/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/local/markup/js/html5shiv.js"></script>
    <script src="/local/markup/js/respond.js"></script>
    
    <!-- dev scripts -->
    <script type="text/javascript" src="/local/markup/js/jquery.js"></script>
    <script src="/local/markup/js/instafeed.min.js"></script>

    <![endif]-->
    <? $APPLICATION->ShowHead() ?>
</head>
<body class="<?= MainHelper::isMainPage() ? 'if-is-homepage' : '' ?>">
<? $APPLICATION->ShowPanel(); ?>
<header class="st-header">
    <div class="st-container header-top-row cf">
        <a class="st-logo fleft" href="/"><img src="/local/markup/img/logo.png"/> </a>

        <div class="fleft search-wrapper">
            <form action="/search/">
                <div class="input">
                    <input class="search-input fleft" type="text" name="q" value="" autocomplete="off"
                           placeholder="Поиск по каталогу">
                    <input name="s" type="submit" value="" class="search-submit fleft">
                </div>
            </form>
        </div>
        <div class="fright text-right item-buttons">
            <? if (MainHelper::isMainPage()): ?>
                <a class="st-cart-link" href="/personal/cart/"><span class="st-cart"><img
                            src="/local/markup/img/cart.png"/></span></a>
                <?
                if ($USER->IsAuthorized()):
                    ?>
                    <a class="st-user-link" href="/personal/"><span class="st-user"><img
                                src="/local/markup/img/user.png"/></span></a>
                <? else: ?>
                    <a class="st-user-link fbox fancybox.ajax" data-fancybox-type="ajax"
                       href="/local/ajax/auth.php"><span class="st-user"><img
                                src="/local/markup/img/user.png"/></span></a>
                <?endif; ?>
            <? else: ?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.line",
                    "basket-link",
                    Array(
                        "PATH_TO_BASKET" => SITE_DIR . "personal/cart/", // Страница корзины
                        "PATH_TO_PERSONAL" => SITE_DIR . "personal/", // Персональный раздел
                        "SHOW_PERSONAL_LINK" => "N", // Отображать персональный раздел
                        "SHOW_NUM_PRODUCTS" => "Y", // Показывать количество товаров
                        "SHOW_TOTAL_PRICE" => "N", // Показывать общую сумму по товарам
                        "SHOW_EMPTY_VALUES" => "Y", // Выводить нулевые значения в пустой корзине
                        "SHOW_PRODUCTS" => "N", // Показывать список товаров
                        "POSITION_FIXED" => "N", // Отображать корзину поверх шаблона
                    ),
                    false
                );?>
                <?
                if ($USER->IsAuthorized()):
                    ?>
                    <a class="st-user-link" href="/personal/"><span class="st-user"><img
                                src="/local/markup/img/user.png"/></span>Личный кабинет</a>
                <? else: ?>
                    <a class="st-user-link fbox fancybox.ajax" data-fancybox-type="ajax"
                       href="/local/ajax/auth.php"><span class="st-user"><img
                                src="/local/markup/img/user.png"/></span>Личный кабинет</a>
                <?endif; ?>
            <?endif; ?>
        </div>
    </div>
    <nav class="nav-wrap st-container <?= MainHelper::getNavClass() ?>">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "top-catalog",
            array(
                "ROOT_MENU_TYPE" => "top",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => array(),
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N"
            ),
            false
        );?>
    </nav>
    <? if (MainHelper::isMainPage()): ?>
        <div class="banner-main-wrap">
            <div class="banner-slider-wrapper-outer">
                <?
                $helper = new MainHelper();
                if ($leftBanner = $helper->getPosBanner('Слева')):?>
                    <a class="sidebanner-left banner_hover" <?= $leftBanner['PROPERTY_LINK_VALUE'] ? 'href="' . $leftBanner['PROPERTY_LINK_VALUE'] . '"' : '' ?>><img
                            src="<?= CFile::GetPath($leftBanner['PREVIEW_PICTURE']) ?>"/></a>
                <?
                endif;
                ?>
                <?
                if ($rightBanner = $helper->getPosBanner('Справа')):
                    ?>
                    <a class="sidebanner-right banner_hover" <?= $rightBanner['PROPERTY_LINK_VALUE'] ? 'href="' . $rightBanner['PROPERTY_LINK_VALUE'] . '"' : '' ?>><img
                            src="<?= CFile::GetPath($rightBanner['PREVIEW_PICTURE']) ?>"/></a>
                <?
                endif;
                ?>


                <div class="banner-slider-wrapper-inner">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "main-slider",
                        Array(
                            "IBLOCK_TYPE" => "services",
                            // Тип информационного блока (используется только для проверки)
                            "IBLOCK_ID" => "7",
                            // Код информационного блока
                            "NEWS_COUNT" => "20",
                            // Количество новостей на странице
                            "SORT_BY1" => "SORT",
                            // Поле для первой сортировки новостей
                            "SORT_ORDER1" => "ASC",
                            // Направление для первой сортировки новостей
                            "SORT_BY2" => "",
                            // Поле для второй сортировки новостей
                            "SORT_ORDER2" => "",
                            // Направление для второй сортировки новостей
                            "FILTER_NAME" => "",
                            // Фильтр
                            "FIELD_CODE" => array( // Поля
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array( // Свойства
                                0 => "LINK",
                                1 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            // Показывать только активные на данный момент элементы
                            "DETAIL_URL" => "",
                            // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                            "AJAX_MODE" => "N",
                            // Включить режим AJAX
                            "AJAX_OPTION_JUMP" => "N",
                            // Включить прокрутку к началу компонента
                            "AJAX_OPTION_STYLE" => "Y",
                            // Включить подгрузку стилей
                            "AJAX_OPTION_HISTORY" => "N",
                            // Включить эмуляцию навигации браузера
                            "CACHE_TYPE" => "A",
                            // Тип кеширования
                            "CACHE_TIME" => "36000000",
                            // Время кеширования (сек.)
                            "CACHE_FILTER" => "N",
                            // Кешировать при установленном фильтре
                            "CACHE_GROUPS" => "Y",
                            // Учитывать права доступа
                            "PREVIEW_TRUNCATE_LEN" => "",
                            // Максимальная длина анонса для вывода (только для типа текст)
                            "ACTIVE_DATE_FORMAT" => "",
                            // Формат показа даты
                            "SET_STATUS_404" => "N",
                            // Устанавливать статус 404, если не найдены элемент или раздел
                            "SET_TITLE" => "N",
                            // Устанавливать заголовок страницы
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            // Включать инфоблок в цепочку навигации
                            "ADD_SECTIONS_CHAIN" => "N",
                            // Включать раздел в цепочку навигации
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            // Скрывать ссылку, если нет детального описания
                            "PARENT_SECTION" => "",
                            // ID раздела
                            "PARENT_SECTION_CODE" => "",
                            // Код раздела
                            "INCLUDE_SUBSECTIONS" => "Y",
                            // Показывать элементы подразделов раздела
                            "DISPLAY_DATE" => "Y",
                            // Выводить дату элемента
                            "DISPLAY_NAME" => "Y",
                            // Выводить название элемента
                            "DISPLAY_PICTURE" => "Y",
                            // Выводить изображение для анонса
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            // Выводить текст анонса
                            "PAGER_TEMPLATE" => "",
                            // Шаблон постраничной навигации
                            "DISPLAY_TOP_PAGER" => "N",
                            // Выводить над списком
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            // Выводить под списком
                            "PAGER_TITLE" => "Новости",
                            // Название категорий
                            "PAGER_SHOW_ALWAYS" => "N",
                            // Выводить всегда
                            "PAGER_DESC_NUMBERING" => "N",
                            // Использовать обратную навигацию
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            // Время кеширования страниц для обратной навигации
                            "PAGER_SHOW_ALL" => "N",
                            // Показывать ссылку "Все"
                        ),
                        false
                    );?>

                </div>
            </div>
        </div>
    <? endif; ?>
</header>
<div class="st-content st-container">
    <? if (!MainHelper::isMainPage()): ?>
        <?if(!MainHelper::isCatalog()):?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "bread",
                Array(
                    "START_FROM" => "0",
                    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    "PATH" => "",
                    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                    "SITE_ID" => "-",
                    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                ),
                false
            );?>
        <?endif;?>
        <? if (!CSite::InDir('/register/')): ?>
            <h1><?= $APPLICATION->ShowTitle(); ?></h1>
        <? endif; ?>
    <? endif; ?>