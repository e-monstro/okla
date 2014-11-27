<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<a class="fred-prev2" href="#"></a>
<a class="fred-next2" href="#"></a>
<ul class="list-unstyled cf st-carousel js-fred2">
    <?foreach($arResult['ITEMS'] as $arItem):?>
        <li>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"/></a>
        </li>
    <?endforeach;?>
</ul>
