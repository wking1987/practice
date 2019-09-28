<?php
header("Content-type:text/html;charset=utf-8");
$int = 2017136;
$str = "<p id=\"zj_area\">红球号码： <span class=\"red_ball\">03</span><span class=\"red_ball\">07</span><span class=\"red_ball\">10</span><span class=\"red_ball\">18</span><span class=\"red_ball\">21</span><span class=\"red_ball\">24</span><span class=\"blue_ball\">12</span>";
echo "<textarea>";
echo $str;
echo "</textarea>";


function getHTTPS($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}


$pattern_red = "/class=\"red_ball\">(\d{2})<\/span>/";
preg_match_all($pattern_red , $str , $arr_red);
$pattern_blue = "/class=\"blue_ball\">(\d{2})<\/span>/";
preg_match_all($pattern_blue , $str , $arr_blue);
echo "<pre>";
print_r($arr_red);
print_r($arr_blue);