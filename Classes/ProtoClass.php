<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/4/16 22:59
 */
namespace Classes;
interface ProtoClass{
    //链接url
    function conn($url);
    //发送get请求
    function get();
    //发送post请求
    function post();
    //关闭链接
    function close();
}