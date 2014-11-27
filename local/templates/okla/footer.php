</div>
<div class="footer">
    <div class="st-container st-footer-container">
        <div class="footer-blk">
            <ul class="list-unstyled cf footer-nav">
                <li>
                    <a href="/about/">О компании</a>
                </li>
                <li>
                    <a href="/about/vacancies/">Вакансии</a>
                </li>
                <li>
                    <a href="/about/delivery/">Доставка</a>
                </li>
                <li>
                    <a href="/about/tkani/">Ткани</a>
                </li>
                <li>
                    <a href="/about/">Контакты</a>
                </li>
            </ul>
            <div class="cf">
                <div class="fleft">
                    <div class="footer-compname">2014. ОКЛА Ретейл</div>
                    <div class="footer-inn">ИНН: 54646516132</div>
                </div>
                <div class="fright">
                    <ul class="list-unstyled cf footer-social">
                        <li>
                            <a class="st-vk" href="https://vk.com/okla4u_ykt" target="_blank"></a>
                        </li>
                        <li>
                            <a class="st-fb" href="https://www.facebook.com/oklaretail" target="_blank"></a>
                        </li>
                        <li>
                            <a class="st-inst" href="http://instagram.com/okla_ykt" target="_blank"></a>
                        </li>
                        <li>
                            <a class="st-tw" href="https://twitter.com/oklaretail" target="_blank"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="map-wrap">
        <div class="abs-ymap">
            <?$APPLICATION->IncludeComponent(
                "bitrix:map.yandex.view",
                ".default",
                array(
                    "INIT_MAP_TYPE" => "MAP",
                    "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:62.031398999982144;s:10:\"yandex_lon\";d:129.74210099999996;s:12:\"yandex_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:129.74259199814;s:3:\"LAT\";d:62.031578917948;s:4:\"TEXT\";s:0:\"\";}}}",
                    "MAP_WIDTH" => "1920",
                    "MAP_HEIGHT" => "300",
                    "CONTROLS" => array(),
                    "OPTIONS" => array(
                        0 => "ENABLE_DBLCLICK_ZOOM",
                        1 => "ENABLE_RIGHT_MAGNIFIER",
                        2 => "ENABLE_DRAGGING",
                    ),
                    "MAP_ID" => "footmap"
                ),
                false
            );?>
        </div>
    </div>
</div>

<!-- scripts except jquery lib -->
<script type="text/javascript" src="/local/markup/js/fredsel.js"></script>
<script type="text/javascript" src="/local/markup/js/fancybox.js"></script>
<script type="text/javascript" src="/local/markup/js/select2.js"></script>
<script type="text/javascript" src="/local/markup/js/checkbox.js"></script>
<script type="text/javascript" src="/local/markup/js/jquery-ui.js"></script>
<script type="text/javascript" src="/local/markup/js/wheel.js"></script>
<script type="text/javascript" src="/local/markup/js/scrollpane.js"></script>
<script type="text/javascript" src="/local/markup/js/scripts.js"></script>
<script src="<?=CUtil::GetAdditionalFileURL('/local/assets/js/app.js')?>"></script>
</body>
</html>