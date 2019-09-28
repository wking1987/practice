<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        $userMod = D("User");
        $list = $userMod -> select();
        echo U("index/double");
        echo "<pre>";
        print_r($list);
        $this -> display();
    }

    /*
     * 读取网上记录，并写入数据表
     * http://tp3.ttfendou.com/index.php?s=/Home/index/double.html
     * */
    public function double()
    {
        $doubleModel = D('double');
        $page_count = $doubleModel::$page_count_page;
        for($i = 1 ; $i <= $page_count ; $i ++)
        {
            $content = $doubleModel -> getContent($i);
            foreach($content as $key => $value)
            {
                $exists = $doubleModel -> where('num=' . $value['num']) -> count();
                if($exists == 0)
                {
                    $insert_result = $doubleModel -> add($value);
                    if($insert_result)
                    {
                        echo 'insert[' . $value['num'] . ']<br/>';
                    }
                }else{
                    echo "exists[" . $value['num'] . "]<br/>this is all <br/>";
                    return;
                }

            }
        }

    }

    public function showdouble()
    {
//        echo U('Home/index/showdouble' , array('p'=>1));
        $page = intval($_GET['p']);
        $page = $page > 0 ? $page : 1;
        $doubleModel = D('double');
        $double_arr = $doubleModel -> getAll($page);
        $page_str = $doubleModel -> getPageStr($page);
        $this -> assign('data' , $double_arr);
        $this -> assign('page' , $page_str);
        $this -> assign('title' , '显示');
        $this -> display();
    }

    /*
     * 新创建一个
     * http://tp3.ttfendou.com/index.php?s=/Home/index/getnew.html
     * */
    public function getnew()
    {
        $doubleModel = D('double');
        $infoLast = $doubleModel -> getLastNum();
        $this -> assign('info' , $infoLast);
        $new_num = $infoLast['num']+1;
        $new_doubles = $doubleModel -> getNew($new_num);
        $this -> assign('data' , $new_doubles);
        $this -> assign('title' , '新的');
        $sub_url = U("Index/buy" , [] , 'html' , true);
        $this -> assign('sub_url' , $sub_url);
        $this -> display();

    }
}