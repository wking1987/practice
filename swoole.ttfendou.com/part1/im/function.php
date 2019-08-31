<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 18:20
 */

/**
 * @param $content
 * @param string $filename
 */

define("USER_FILE_NAME" , './user.txt');
function write_user_file($content , $filename = ''){
    if(empty($filename)) {
        $filename = USER_FILE_NAME;
    }
    if(!file_exists($filename)){
        touch($filename);
    }
    file_put_contents($filename , $content);
}

function read_user_file($filename = ''){
    $filename = $filename ? $filename : USER_FILE_NAME;
    if(!file_exists($filename)){
        touch($filename);
        return '';
    }
    $content = file_get_contents($filename);
    return $content;

}

function get_user_list(){
    $user_list = json_decode(read_user_file() , true);
    $user_list = empty($user_list) ? [] : $user_list;
    return $user_list;
}

function save_user_list($user_list){
    if(is_array($user_list)){
        $content = json_encode($user_list);
    }else{
        $content = $user_list;
    }
    write_user_file($content);
}

function set_user($user) {
    $user_list = get_user_list();
    $user_list[$user['id']] = $user;
    save_user_list($user_list);
}

function delete_user($user) {
    $user_list = get_user_list();
    unset($user_list[$user['id']]);
    save_user_list($user_list);
}