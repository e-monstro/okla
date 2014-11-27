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

CJSCore::Init(array("fx"));

if (file_exists(
    $_SERVER["DOCUMENT_ROOT"] . $this->GetFolder() . '/themes/' . $arParams["TEMPLATE_THEME"] . '/colors.css'
)
) {
    $APPLICATION->SetAdditionalCSS($this->GetFolder() . '/themes/' . $arParams["TEMPLATE_THEME"] . '/colors.css');
}
?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input
            type="hidden"
            name="<? echo $arItem["CONTROL_NAME"] ?>"
            id="<? echo $arItem["CONTROL_ID"] ?>"
            value="<? echo $arItem["HTML_VALUE"] ?>"
            />
    <? endforeach; ?>
    <?
    // size
    if ($arResult['ITEMS'][29] && count($arResult['ITEMS'][29]['VALUES'])):
        ?>
        <div class="sidebar-cont <?=count($arResult['ITEMS'][29]['VALUES']) > 28 ? 'scroll-pane' : ''?> product-categories">
            <div class="aside-title">Выберите размер</div>
            <ul class="list-unstyled sidebar-prod-sizes cf">
                <? //MainHelper::akPre($arResult['ITEMS']); die();?>
                <? foreach ($arResult['ITEMS'][29]['VALUES'] as $sizeValue): ?>
                    <li>
                        <input type="checkbox"
                               id="<?= $sizeValue['CONTROL_ID'] ?>"
                            <?= $sizeValue['CHECKED'] ? 'checked' : '' ?>
                               name="<?= $sizeValue['CONTROL_NAME'] ?>"
                               value="<?= $sizeValue['HTML_VALUE'] ?>"/>
                        <label for="<?= $sizeValue['CONTROL_ID'] ?>" class="label_<?= $sizeValue['CONTROL_ID']?>">
                            <?= $sizeValue['VALUE'] ?>
                        </label>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    <?
    endif;
    ?>

    <?
    // brand
    if ($arResult['ITEMS'][43] && count($arResult['ITEMS'][43]['VALUES'])):
        ?>
        <div class="sidebar-cont no-padding">
            <input type="text" placeholder="Поиск бренда" class="brand-search-input"/>

            <div class="brand-blk scroll-pane brand-search-blk">
                <ul class="list-unstyled check-list-items">
                    <? foreach ($arResult['ITEMS'][43]['VALUES'] as $brandVal): ?>
                        <li>
                            <input id="<?= $brandVal['CONTROL_ID'] ?>"
                                   type="checkbox"
                                   name="<?= $brandVal['CONTROL_NAME'] ?>"
                                   value="<?= $brandVal['HTML_VALUE'] ?>"
                                <?= $brandVal['CHECKED'] ? 'checked' : '' ?>
                                />
                            <label for="<?= $brandVal['CONTROL_ID'] ?>" data-class="label_<?= $brandVal['CONTROL_ID']?>">
                               <?= $brandVal['VALUE'] ?>
                            </label>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    <?
    endif;
    ?>

    <?
    //fake price (PROPERTY_MINIMUM_PRICE)
    if ($arResult['ITEMS'][58] && $arResult['ITEMS'][58]['VALUES']):
        ?>
        <div class="sidebar-cont">
            <div class="aside-title">Цена</div>
            <div class="range-wrapper">
                <div class="js-slider"></div>
            </div>
            <div class="cf inps-group">
                <div class="fleft t-mrg">
                    от
                </div>
                <div class="fleft">
                    <input id="minCost" class="range-input label_<?= $arResult['ITEMS'][58]['VALUES']['MIN']['CONTROL_NAME'] ?>" type="text"
                           name="<?= $arResult['ITEMS'][58]['VALUES']['MIN']['CONTROL_NAME'] ?>"
                           value="<?= $arResult['ITEMS'][58]['VALUES']['MIN']['VALUE'] ?>"/>
                </div>
                <div class="fleft t-mrg">
                    до
                </div>
                <div class="fleft">
                    <input id="maxCost" class="range-input label_<?= $arResult['ITEMS'][58]['VALUES']['MAX']['CONTROL_NAME'] ?>" type="text"
                           name="<?= $arResult['ITEMS'][58]['VALUES']['MAX']['CONTROL_NAME'] ?>"
                           value="<?= $arResult['ITEMS'][58]['VALUES']['MAX']['VALUE'] ?>"/>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $(".js-slider").slider({
                    range: true,
                    min: <?=$arResult['ITEMS'][58]['VALUES']['MIN']['VALUE']?>,
                    max: <?=$arResult['ITEMS'][58]['VALUES']['MAX']['VALUE']?>,
                    values: [ <?=$arResult['ITEMS'][58]['VALUES']['MIN']['VALUE']?>, <?=$arResult['ITEMS'][58]['VALUES']['MAX']['VALUE']?> ],
                    stop: function (event, ui) {
                        $("input#minCost").val($(".js-slider").slider("values", 0));
                        $("input#maxCost").val($(".js-slider").slider("values", 1));
                        filterAjaxSubmit($("input#maxCost"));
                    },
                    slide: function (event, ui) {
                        $("input#minCost").val($(".js-slider").slider("values", 0));
                        $("input#maxCost").val($(".js-slider").slider("values", 1));

                    }
                });
            });
        </script>
    <?
    endif;
    ?>

    <?
    //material
    if ($arResult['ITEMS'][6] && $arResult['ITEMS'][6]['VALUES']):
        ?>
        <div class="sidebar-cont prod-items-blk scroll-pane product-categories">
            <div class="aside-title">Материал</div>
            <ul class="list-unstyled check-list-items">
                <? foreach ($arResult['ITEMS'][6]['VALUES'] as $brandVal): ?>
                    <li>
                        <input id="<?= $brandVal['CONTROL_ID'] ?>"
                               type="checkbox"
                               name="<?= $brandVal['CONTROL_NAME'] ?>"
                               value="<?= $brandVal['HTML_VALUE'] ?>"
                            <?= $brandVal['CHECKED'] ? 'checked' : '' ?>
                            />
                        <label for="<?= $brandVal['CONTROL_ID'] ?>">
                            <?= $brandVal['VALUE'] ?>
                        </label>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
    <?
    endif;
    ?>

    <input type="hidden" id="set_filter" name="set_filter" value="Y"/>
    <input class="smart-filter-submit" type="submit" id="set_filter" name="set_filter" value="Y"/>
    <input class="smart-filter-reset" type="submit" id="del_filter" name="del_filter"
           value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"/>
</form>