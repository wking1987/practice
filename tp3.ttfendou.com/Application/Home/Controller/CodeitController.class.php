<?php
/**
 * Created by wking
 * Date: 2019/12/18
 * Time: 17:35
 */
namespace Home\Controller;
use Think\Controller;

//use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
//use CodeItNow\BarcodeBundle\Utils\QrCode;

class CodeitController extends Controller {

    public function index()
    {
//        import("Vender.CodeItNow.BarcodeBundle.Utils.BarcodeGenerator");
        include_once './Thinkphp/Vender/CodeItNow/BarcodeBundle/Utils/BarcodeGenerator';
        import("Vender.CodeItNow.BarcodeBundle.Utils.BarcodeGenerator");
        echo '<hr>';
        echo '<p>Example - Code128</p>';
        $barcode = new BarcodeGenerator();
        $barcode->setText("0123456789");
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();
        echo '<img src="data:image/png;base64,' . $code . '" />';
    }
}