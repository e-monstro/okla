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
$arPageCount = array(
    24,
    48,
    96
);

$pageCount = $arParams['PAGE_ELEMENT_COUNT'];
?>
    <div class="filter-wrapper">
        <div class="t-cell">
            Показывать по:
            <ul class="list-unstyled list-t1">
                <? foreach ($arPageCount as $count): ?>
                    <li class="<?= $count == $pageCount ? 'active' : '' ?>">
                        <a href="<?=
                        $APPLICATION->GetCurPageParam(
                            'pageCount=' . $count,
                            array('pageCount')
                        ) ?>"><?= $count ?></a>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <?
        $arSort = array(
            'property_MINIMUM_PRICE' => 'цене',
            'timestamp_x' => 'дате',
            'shows' => 'популярности'
        );

        $sortField = $arParams['ELEMENT_SORT_FIELD'];
        $sortOrder = $arParams['ELEMENT_SORT_ORDER'];

        ?>
        <div class="t-cell filter-mid">
            Сортировать по:
            <ul class="list-unstyled list-t1">
                <? foreach ($arSort as $field => $sV): ?>
                    <?
                    if ($field == $sortField) {
                        $activeClass = 'active-sort';
                        $arrow = '<img src="/local/markup/img/arr_' . $sortOrder . '.png"/>';
                        $newOrder = $sortOrder == 'desc' ? 'asc' : 'desc';
                    } else {
                        $activeClass = '';
                        $arrow = '';
                        $newOrder = 'asc';
                    }
                    ?>
                    <li class="<?= $activeClass ?>">
                        <a href="<?=
                        $APPLICATION->GetCurPageParam(
                            'sort=' . $field . '&order=' . $newOrder,
                            array('sort', 'order')
                        ) ?>"><?= $sV ?></a> <?= $arrow ?>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <div class="t-cell">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    </div>
<?
global $arrFilter;
//MainHelper::akPre($arrFilter);
if ($_GET['set_filter'] == 'Y'):
    ?>
    <div class="chosen-wrapper">
        Вы выбрали:
        <ul class="list-unstyled del-list">
            <?
            foreach ($_GET as $varName => $varVal):
                if (strpos($varName, $arParams['FILTER_NAME']) === false) {
                    continue;
                }
                ?>
                <? if (!intval($varVal)): ?>
                <li data-remove-href="<?= $APPLICATION->GetCurPageParam('', array($varName)) ?>"
                    data-field-id="<?= $varName ?>"
                    class="remove-fields"><span class="st-remove-text"></span><span class="st-remove"></span>
                </li>
            <? endif; ?>
            <? endforeach; ?>
            <li data-remove-href="<?= $APPLICATION->GetCurPageParam(
                '',
                array('arrFilter_58_MIN', 'arrFilter_58_MAX')
            ) ?>"
                data-field-id="arrFilter_58_MIN"
                class="remove-fields get-from-input">
                От <span class="st-remove-text"></span> р.<span class="st-remove"></span>
            </li>
            <li data-remove-href="<?= $APPLICATION->GetCurPageParam(
                '',
                array('arrFilter_58_MIN', 'arrFilter_58_MAX')
            ) ?>"
                data-field-id="arrFilter_58_MAX"
                class="remove-fields get-from-input">
                До <span class="st-remove-text"></span> р. <span class="st-remove"></span>
            </li>
        </ul>

    </div>
    <?
    if (!MainHelper::isAjaxRequest()):
        ?>
            <script>
                $(document).ready(function(){
                    $('.remove-fields').each(function () {
                        var fieldInFilter = $(this).data('field-id');

                        if (!$(this).hasClass('get-from-input')) {
                            if ($('.label_' + fieldInFilter).length > 0) {
                                var removeText = $('.label_' + fieldInFilter).text();
                            } else {
                                var removeText = $('[for="' + fieldInFilter + '"]').text();
                            }
                        } else {
                            var removeText = $('.label_' + fieldInFilter).val();
                        }
                        $(this).find('.st-remove-text').text(removeText);
                    });
                });
            </script>
    <? endif; ?>
<? endif; ?>
<? if (count($arResult['ITEMS']) > 0): ?>
    <ul class="list-unstyled st-prod-list-four cf">
        <? foreach ($arResult['ITEMS'] as $k => $arItem): ?>
            <li>
                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="st-product-block">
                    <div class="st-prod-img-wrap">
                        <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>"/>
                    </div>
                    <div class="st-product-title-price">
                        <div class="st-product-title">
                            <?
                            if (strpos($arItem['NAME'], ',') !== false):
                                list($name, $rem) = explode(',', $arItem['NAME'], 2);

                                if (strlen($name) > 20):
                                    $name = TruncateText($arItem['NAME'], 20);
                                endif;
                            else:
                                $name = TruncateText($arItem['NAME'], 20);
                            endif; ?>

                            <?= $name ?>
                        </div>
                        <div class="st-product-price"><?= round($arItem['PROPERTIES']['MINIMUM_PRICE']['VALUE']) ?>
                            руб.
                        </div>
                    </div>
                    <? if (count($arItem['SIZES']) > 0): ?>
                        <div class="st-product-layer">
                            <div class="st-product-layer-cell">
                                <div class="st-product-layer-title text-center">
                                    Размеры
                                </div>
                                <ul class="list-unstyled st-prod-sizes cf">
                                    <? foreach ($arItem['SIZES'] as $size): ?>
                                        <li><?= $size ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <? endif; ?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
<? else: ?>
    <p class="no-products">Нет товаров, соответствующих выбранным параметрам.</p>

<?endif; ?>