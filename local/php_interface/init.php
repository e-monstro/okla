<?
require_once 'classes/helpers/MainHelper.php';

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "BXIBlockAfterSave");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "BXIBlockAfterSave");
AddEventHandler("catalog", "OnPriceAdd", "BXIBlockAfterSave");
AddEventHandler("catalog", "OnPriceUpdate", "BXIBlockAfterSave");



function BXIBlockAfterSave($arg1, $arg2 = false)
{

    $ELEMENT_ID = false;
    $IBLOCK_ID = false;
    $OFFERS_IBLOCK_ID = false;
    $OFFERS_PROPERTY_ID = false;

    //Check for catalog event
    if(is_array($arg2) && $arg2["PRODUCT_ID"] > 0)
    {
        //Get iblock element
        $rsPriceElement = CIBlockElement::GetList(
            array(),
            array(
                "ID" => $arg2["PRODUCT_ID"],
            ),
            false,
            false,
            array("ID", "IBLOCK_ID")
        );
        if($arPriceElement = $rsPriceElement->Fetch())
        {
            $arCatalog = CCatalog::GetByID($arPriceElement["IBLOCK_ID"]);
            if(is_array($arCatalog))
            {
                //Check if it is offers iblock
                if($arCatalog["OFFERS"] == "Y")
                {
                    //Find product element
                    $rsElement = CIBlockElement::GetProperty(
                        $arPriceElement["IBLOCK_ID"],
                        $arPriceElement["ID"],
                        "sort",
                        "asc",
                        array("ID" => $arCatalog["SKU_PROPERTY_ID"])
                    );
                    $arElement = $rsElement->Fetch();
                    if($arElement && $arElement["VALUE"] > 0)
                    {
                        $ELEMENT_ID = $arElement["VALUE"];
                        $IBLOCK_ID = $arCatalog["PRODUCT_IBLOCK_ID"];
                        $OFFERS_IBLOCK_ID = $arCatalog["IBLOCK_ID"];
                        $OFFERS_PROPERTY_ID = $arCatalog["SKU_PROPERTY_ID"];
                    }
                }
                //or iblock wich has offers
                elseif($arCatalog["OFFERS_IBLOCK_ID"] > 0)
                {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = $arCatalog["OFFERS_IBLOCK_ID"];
                    $OFFERS_PROPERTY_ID = $arCatalog["OFFERS_PROPERTY_ID"];
                }
                //or it's regular catalog
                else
                {
                    $ELEMENT_ID = $arPriceElement["ID"];
                    $IBLOCK_ID = $arPriceElement["IBLOCK_ID"];
                    $OFFERS_IBLOCK_ID = false;
                    $OFFERS_PROPERTY_ID = false;
                }
            }
        }
    }
    //Check for iblock event
    elseif(is_array($arg1) && $arg1["ID"] > 0 && $arg1["IBLOCK_ID"] > 0)
    {
        //Check if iblock has offers
        $arOffers = CIBlockPriceTools::GetOffersIBlock($arg1["IBLOCK_ID"]);
        if(is_array($arOffers))
        {
            $ELEMENT_ID = $arg1["ID"];
            $IBLOCK_ID = $arg1["IBLOCK_ID"];
            $OFFERS_IBLOCK_ID = $arOffers["OFFERS_IBLOCK_ID"];
            $OFFERS_PROPERTY_ID = $arOffers["OFFERS_PROPERTY_ID"];
        }
    }

    if($ELEMENT_ID)
    {
        static $arPropCache = array();
        if(!array_key_exists($IBLOCK_ID, $arPropCache))
        {
            //Check for MINIMAL_PRICE property
            $rsProperty = CIBlockProperty::GetByID("MINIMUM_PRICE", $IBLOCK_ID);
            $arProperty = $rsProperty->Fetch();
            if($arProperty)
                $arPropCache[$IBLOCK_ID] = $arProperty["ID"];
            else
                $arPropCache[$IBLOCK_ID] = false;
        }

        if($arPropCache[$IBLOCK_ID])
        {
            //Compose elements filter
            $arProductID = array($ELEMENT_ID);
            if($OFFERS_IBLOCK_ID)
            {
                $rsOffers = CIBlockElement::GetList(
                    array(),
                    array(
                        "IBLOCK_ID" => $OFFERS_IBLOCK_ID,
                        "PROPERTY_".$OFFERS_PROPERTY_ID => $ELEMENT_ID,
                    ),
                    false,
                    false,
                    array("ID")
                );
                while($arOffer = $rsOffers->Fetch())
                    $arProductID[] = $arOffer["ID"];
            }

            $minPrice = false;
            $maxPrice = false;

            //Get prices
            $rsPrices = CPrice::GetList(
                array(),
                array(
                    "BASE" => "Y",
                    "PRODUCT_ID" => $arProductID,
                )
            );
            while($arPrice = $rsPrices->Fetch())
            {
                $PRICE = $arPrice["PRICE"];

                if($minPrice === false || $minPrice > $PRICE)
                    $minPrice = $PRICE;

                if($maxPrice === false || $maxPrice < $PRICE)
                    $maxPrice = $PRICE;
            }

            //Save found minimal price into property
            //CPrice::SetBasePrice($ELEMENT_ID, $PRICE, 'RUB');

            if($minPrice !== false)
            {
                CIBlockElement::SetPropertyValuesEx(
                    $ELEMENT_ID,
                    $IBLOCK_ID,
                    array(
                        "MINIMUM_PRICE" => $minPrice,
                        "MAXIMUM_PRICE" => $maxPrice,
                    )
                );
                //CPrice::SetBasePrice($ELEMENT_ID, $PRICE, 'RUB');
            }
        }
    }
}
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "PropertyHandler");
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "PropertyHandler");
function PropertyHandler(&$arFields){

    if($arFields["IBLOCK_ID"]=="4"){
        if($arFields["PROPERTY_VALUES"][51])
        {
            $color=false;
            $size=false;
            foreach($arFields["PROPERTY_VALUES"][51] as $k=>$v)
            {
                if(strtolower($v["DESCRIPTION"])=="размер")
                {
                    $size=$v["VALUE"];
                }elseif(strtolower($v["DESCRIPTION"])=="цвет")
                {
                    $color=$v["VALUE"];
                }
            }
            ///check props
            if($size)
            {
                $newSize=false;
                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>4, "CODE"=>"SIZE"));
                while($enum = $property_enums->GetNext()){
                    if($enum['VALUE'] == $size){
                        $newSize = $enum['ID'];
                    }
                }

                if(!$newSize){
                    $ibpenum = new CIBlockPropertyEnum;
                    $PropID = $ibpenum->Add(Array('PROPERTY_ID'=>29, 'VALUE'=>$size));
                    $newSize = $PropID;
                }

                $arFields["PROPERTY_VALUES"][29] = Array("VALUE" => $newSize);

            }
            if($color)
            {
                $newColor=false;
                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>4, "CODE"=>"COLOR"));
                while($enum = $property_enums->GetNext()){
                    if($enum['VALUE'] == $color){
                        $newColor = $enum['ID'];
                    }
                }

                if(!$newColor){
                    $ibpenum = new CIBlockPropertyEnum;
                    $PropID = $ibpenum->Add(Array('PROPERTY_ID'=>28, 'VALUE'=>$color));
                    $newColor = $PropID;
                }

                $arFields["PROPERTY_VALUES"][28] = Array("VALUE" => $newColor);

            }

        }

    }
    return $arFields;
}
function GetBanner()
{
    $a=file_get_contents("http://sprinter-ykt.ru/ajax/banner.php");
    $res=json_decode($a);
    $result=array();
    foreach($res as $r)
    {
        $result[]=get_object_vars($r);
    }
    return $result;
}
?>