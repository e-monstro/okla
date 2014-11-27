<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$ClientID = 'navigation_'.$arResult['NavNum'];

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>
<div class="fleft">
    <select onchange="location.href = $(this).find(':selected').data('url-reload');">
        <?for($i = 1; $i <= $arResult['NavPageCount']; $i++):?>
            <option data-url-reload="<?=$APPLICATION->GetCurPageParam('PAGEN_' . $arResult['NavNum'] . '=' . $i, array('PAGEN_' . $arResult['NavNum']))?>" value="<?=$i?>" <?=$arResult['NavPageNomer'] == $i ? 'selected="selected"' : ''?>><?=$i?></option>
        <?endfor;?>
    </select>
</div>
<div class="fleft mrg-1">
    стр.
</div>