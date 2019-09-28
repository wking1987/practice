<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/3/19 18:00
 */
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> assign('css_url' , C('CSS_URL'));
        $this -> assign('image_url' , C('IMAGE_URL'));
    }
}