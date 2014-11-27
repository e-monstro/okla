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
<?if(count($arResult['ITEMS']) > 0):?>
<ul class="list-unstyled st-prod-list-four cf">
    <?foreach($arResult['ITEMS'] as $k=>$arItem):?>
        <li>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="st-product-block">
                <div class="st-prod-img-wrap">
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"/>
                </div>
                <div class="st-product-title-price">
                    <div class="st-product-title">
                        <?
                        if (strpos($arItem['NAME'], ',') !== false):
                            list($name, $rem) = explode(',', $arItem['NAME'], 2);

                            if(strlen($name) > 20):
                                $name = TruncateText($arItem['NAME'], 20);
                            endif;
                        else:
                            $name = TruncateText($arItem['NAME'], 20);
                        endif; ?>

                        <?=$name?>
                    </div>
                    <div class="st-product-price"><?=round($arItem['PROPERTIES']['MINIMUM_PRICE']['VALUE'])?> руб.</div>
                </div>
                <?if(count($arItem['SIZES'])>0):?>
                    <div class="st-product-layer">
                        <div class="st-product-layer-cell">
                            <div class="st-product-layer-title text-center">
                                Размеры
                            </div>
                            <ul class="list-unstyled st-prod-sizes cf">
                                <?foreach($arItem['SIZES'] as $size):?>
                                    <li><?=$size?></li>
                                <?endforeach;?>
                            </ul>
                        </div>
                    </div>
                <?endif;?>
            </a>
        </li>
    <?endforeach;?>
</ul>
<?endif;?>