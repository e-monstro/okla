<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    
<?if (!empty($arResult)):?>
<ul class="list-unstyled st-nav st-container">

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-active<?else:?>root-item<?endif?>"><?=substr($arItem['TEXT'], 0, 12)?></a>
				<ul>
		<?else:?>
			<li<?if ($arItem["SELECTED"]):?> class="root-active"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=substr($arItem['TEXT'], 0, 12)?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-active<?else:?>root-item<?endif?>"><?=substr($arItem['TEXT'], 0, 12)?></a></li>
			<?else:?>
				<li<?if ($arItem["SELECTED"]):?> class="root-active"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=substr($arItem['TEXT'], 0, 12)?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-active<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=substr($arItem['TEXT'], 0, 12)?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=substr($arItem['TEXT'], 0, 12)?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
    <li class="st-active">
        <a href="/sale/">РАСПРОДАЖА</a>
    </li>
</ul>
<?endif?>