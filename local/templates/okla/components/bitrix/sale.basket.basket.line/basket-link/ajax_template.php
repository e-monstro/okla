<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
$this->IncludeLangFile('template.php');
?>
	<a href="<?=$arParams['PATH_TO_BASKET']?>" class="st-cart-link">
        <span class="st-cart"><img src="/local/markup/img/cart.png" /></span>В корзине<?if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')):?>
            <?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?><?endif?></a>


	<?if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
		<br>
		<span class="icon_spacer"></span>
		<?=GetMessage('TSB1_TOTAL_PRICE')?>
		<?if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
			<strong><?=$arResult['TOTAL_PRICE']?></strong>
		<?endif?>
	<?endif?>
