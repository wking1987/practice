<?php
/**
 * Created by wking
 * Date: 2019/12/19
 * Time: 8:49
 */
namespace CodeItNow;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use CodeItNow\BarcodeBundle\Utils\QrCode;

echo '<p>Example - QrCode</p>';
echo '<hr>';
echo '<p>Example - Code128</p>';
$barcode = new BarcodeGenerator();
$barcode->setText("1293819812398zzz");
$barcode->setType(BarcodeGenerator::Code128);
$barcode->setScale(2);
$barcode->setThickness(25);
$barcode->setFontSize(10);
$code = $barcode->generate();
echo "<textarea>";
echo $code;
echo "</textarea>";
echo '<img height="40" src="data:image/png;base64,' . $code . '" />';