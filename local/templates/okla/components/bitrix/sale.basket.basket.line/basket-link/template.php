<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$style = 'bx_cart_block';

if ($arParams['SHOW_PRODUCTS'] == 'Y')
	$style .= ' bx_cart_sidebar';

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$style .= " bx_cart_fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$style .= ' close';
}
?>
		<?require(realpath(dirname(__FILE__)).'/ajax_template.php')?>