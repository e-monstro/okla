<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Распродажа");
?>

    <div class="cf catalog-container">
    <?
        global $arrSaleFilter;
        $arrSaleFilter['!CATALOG_PRICE_3'] = false;
    ?>


    <div class="loader-wrapper">
        <div id="spinner"></div>
    </div>
    </div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>