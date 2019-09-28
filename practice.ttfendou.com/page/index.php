<?php
require_once __DIR__ . '/../common/common.php';


$tables = $db -> desc_table('double_ball');
echo $db -> get_error();
print_r($tables);


exit;
$url = 'http://m.500.com//info/kaijiang/moreexpect/ssq/?from=index';
$url = 'http://www.cwl.gov.cn/kjxx/ssq/hmhz/index.shtml';
$str = file_get_contents($url);
//$str = iconv('gbk' , 'utf-8' , $str);

echo "<pre>";
echo $str;
echo '</pre>';