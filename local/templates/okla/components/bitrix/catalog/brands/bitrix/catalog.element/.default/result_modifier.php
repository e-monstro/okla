<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$brandName = $arResult['NAME'];

$helper = new MainHelper();

$el = new CIBlockElement();

$brandProducts = $el->GetList(
    array(),
    array(
        'IBLOCK_ID' => $helper->ibConfig['CATALOG'],
        'PROPERTY_BREND_VALUE' => $brandName,
        'ACTIVE' => 'Y'
    ),
    false,
    false,
    array(
        'ID',
        'IBLOCK_SECTION_ID'
    )
);

$arProducts = array();
$arSectionsID = array();

while($prod = $brandProducts->GetNext()){
    $arProducts[$prod['IBLOCK_SECTION_ID']][] = $prod;
    $arSectionsID[] = $prod['IBLOCK_SECTION_ID'];
}

$ibSection = new CIBlockSection();

$sections = $ibSection->GetList(
    array(),
    array('ID' => $arSectionsID),
    false,
    array(
        'ID',
        'NAME',
        'SECTION_PAGE_URL'
    )
);

$arSections = array();

while($sec = $sections->GetNext()){
    $arSections[$sec['ID']] = $sec;
    $arSections[$sec['ID']]['ELEMENTS_COUNT'] = count($arProducts[$sec['ID']]);
}

$arResult['SECTION_LIST'] = $arSections;

?>