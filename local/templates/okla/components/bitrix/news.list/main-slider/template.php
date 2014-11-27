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
<? if (count($arResult['ITEMS']) > 0): ?>
    <ul class="list-unstyled st-banner js-fred1 cf">
        <?foreach($arResult['ITEMS'] as $arItem):?>
            <li>
                <?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
                    <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="banners-slider-anchor">
                <?endif;?>
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"/>
                <?if($arItem['PROPERTIES']['LINK']['VALUE']):?>
                    </a>
                <?endif;?>
            </li>
        <?endforeach;?>
    </ul>
    <div class="arrows-wrapper">
        <div class="arrows-wrapper-inner st-container">
            <div class="cf">
                <a class="fred-prev fleft" href="#"></a>
                <a class="fred-next fleft" href="#"></a>
            </div>
            <div class="pager-of" id="navi">
                <div id="pagenumber"><span></span> из <?=count($arResult['ITEMS'])?></div>
            </div>
        </div>
    </div>
<? endif; ?>