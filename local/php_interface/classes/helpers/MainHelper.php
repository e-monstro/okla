<?

/**
 * @property mixed ibConfig
 */
class MainHelper
{
    public $ibConfig = array(
        'BANNERS' => 10,
        'CATALOG' => 3
    );
    public static function iResize($id, $width, $height, $type=0)
    {
    	if(!$id) return;
    	if($type==0)
    		$img=CFile::ResizeImageget($id, array('width'=>$width, "height"=>$height), BX_RESIZE_IMAGE_EXACT, false);
    	elseif($type==1)
    	$img=CFile::ResizeImageget($id, array('width'=>$width, "height"=>$height), BX_RESIZE_IMAGE_PROPORTIONAL, false);
    	else
    		$img=CFile::ResizeImageget($id, array('width'=>$width, "height"=>$height), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
    	return $img["src"];
    }
    public static function GetColor($name)
    {
    	$a=CIBlockElement::GetList(array(), array("IBLOCK_ID"=>11, "PROPERTY_CODE"=>trim($name)), false, false, array("ID", "NAME", "PROPERTY_CODE", "PROPERTY_PIC"))->GetNext();
    	if($a["ID"])
    	{
    		return array(
    			"NAME"=>$a["NAME"],
    			"CODE"=>$a["PROPERTY_CODE_VALUE"],
    			"PIC"=>self::iResize($a["PROPERTY_PIC_VALUE"], 40, 40)		
    				
    		);
    		
    	}
    	return false;
    	
    }
    static function isMainPage()
    {
        global $APPLICATION;
        return $APPLICATION->GetCurDir() == '/';
    }

    static function isCatalog(){
        return CSite::InDir('/catalog/');
    }

    static function isAjaxRequest(){
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    static function noPhoto()
    {
        //return '/bitrix/components/bitrix/catalog.top/templates/.default/images/no_photo.png';
         return '/local/markup/img/no-image.png';
    }

    static function akPre($array){
        echo "<pre>"; print_r($array); echo "</pre>";
    }

    static function getNavClass(){
        $navClass = 'nav-bg-red';

        if(self::isMainPage()){
            $navClass = '';
        }elseif(CSite::InDir('/personal/') || CSite::InDir('/register/')){
            $navClass = 'nav-bg-green';
        }elseif(CSite::InDir('/catalog/muzhchinam/' || CSite::InDir('/catalog/dlya_muzhchin/'))){
            $navClass = 'nav-bg-man';
        }elseif(CSite::InDir('/catalog/detskaya_odezhda/' || CSite::InDir('/catalog/dlya_detey/'))){
            $navClass = 'nav-bg-children';
        }elseif(CSite::InDir('/catalog/obuv/')){
            $navClass = 'nav-bg-brown';
        }elseif(CSite::InDir('/catalog/nizhnee_bele/')){
            $navClass = 'nav-bg-underwear';
        }


        return $navClass;
    }

    public function getPosBanner($position){
        CModule::IncludeModule('iblock');

        $el = new CIBlockElement();

        $arFilter = array(
            'IBLOCK_ID'=> $this->ibConfig['BANNERS'],
            'ACTIVE' => 'Y',
            'PROPERTY_POSITION_VALUE' => $position
        );

        $banner = $el->GetList(
            array(),
            $arFilter,
            false,
            false,
            array(
                'ID',
                'PROPERTY_LINK',
                'PREVIEW_PICTURE',
                'NAME'
            )
        )->GetNext();

        if($banner['ID']){
            return $banner;
        }else{
            return false;
        }
    }
}

?>