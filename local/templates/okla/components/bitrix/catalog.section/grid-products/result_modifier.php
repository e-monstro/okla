<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//Make all properties present in order
//to prevent html table corruption
foreach($arResult["ITEMS"] as $key => $arElement)
{
	$arRes = array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$arRes[$pid] = CIBlockFormatProperties::GetDisplayValue($arElement, $arElement["PROPERTIES"][$pid], "catalog_out");
	}

    if(!$arElement['PREVIEW_PICTURE']['SRC'] || !file_exists($_SERVER['DOCUMENT_ROOT'] . $arElement['PREVIEW_PICTURE']['SRC'])){
        $arResult["ITEMS"][$key]['PREVIEW_PICTURE']['SRC'] = MainHelper::noPhoto();
    }

    if(count($arElement['OFFERS']) > 0){
        $arSizes = array();
        foreach($arElement['OFFERS'] as $arOffer){

            if($arOffer['CAN_BUY']){
                $arSizes[] = $arOffer['DISPLAY_PROPERTIES']['SIZE']['VALUE'];
            }
        }
    }

    $arResult['ITEMS'][$key]['SIZES'] = $arSizes;

	$arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $arRes;
}
?>