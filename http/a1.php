<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/13
 * Time: 14:47
 */

set_time_limit(30);

ob_start();
//php.ini output_buffering默认是4069字符或者更大，即输出内容必须达到4069字符服务器才会flush刷新输出缓冲
$pad = str_repeat(' ' , 4069);
ob_flush();
flush();
$con = mysqli_connect('127.0.0.1' , 'root' , '' , 'practice');
mysqli_query($con , 'set names utf8');
$sql = 'SELECT * FROM `msg` WHERE `flag`=0 ORDER BY id ASC LIMIT 1';
$filename = date("YmdHis") . '.txt';
//ob_flush()和flush()的区别。
//前者是把数据从PHP的缓冲中释放出来,后者是把不在缓冲中的或者说是被释放出来的数据发送到浏览器。
//所以当缓冲存在的时候，我们必须ob_flush()和flush()同时使用
while(1){
    $res = mysqli_query($con , $sql);
    $row = mysqli_fetch_assoc($res);
    echo '<p style="font-size:10px;">';
    echo $pad;
    echo date("Y-m-d H:i:s");
    echo '</p>';
    echo '<p style="font-size:10px;color:red;">';
    echo $row['content'];
    echo '</p>';
    mysqli_query($con , 'UPDATE `msg` SET `flag`=1 WHERE `id`=' . $row['id']);
    write_log(trim($row['content']) , $filename);
    ob_flush();
    flush();    //把产生的内容立即送给浏览器，而不要等脚本结束再一起送
    sleep(1);
}

function write_log($content = '' , $filename = '') {
    $str = '[' . date("Y-m-d H:i:s") . ']';
    $str .= $content . "\n";
    $filename = $filename ? $filename : 'log.txt';
    $file_handle = fopen($filename, 'a');
    fwrite($file_handle , $str);
    fclose($file_handle);

}