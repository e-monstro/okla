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

if (!empty($arResult['ITEMS'])) {
    ?>
    <ul class="brands-list list-unstyled">
        <?
        foreach ($arResult['ITEMS'] as $arItem):?>
            <li>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
                    <?if($arItem['PREVIEW_PICTURE']):?>
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" />
                    <?else:?>
                        <span><?=$arItem['NAME']?></span>
                    <?endif;?>
                </a>
            </li>
        <?
        endforeach;
        ?>
    </ul>
<?
}
?>