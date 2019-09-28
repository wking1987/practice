<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/3/12 22:33
 */
namespace Home\Model;

use Think\Model;

class DoubleModel extends Model
{
    const NORMAL_STATUS = 1;
    const DEL_STATUS    = 2;

//    static $base_url = 'http://www.cwl.gov.cn/kjxx/ssq/hmhz/index.shtml';
    static $base_url = 'http://kaijiang.zhcw.com/zhcw/html/ssq/list.html';
    static $page_count_page = 112;       //网上的总页数
    static $page_size = 20;         //读库的分页大小
    public $page_count;

    public $red_balls;
    public $blue_ball;

    public function getLastNum()
    {
        $infoLast = $this -> order('num DESC') -> find();
        return $infoLast;
    }

    /**
     * 新的
     * @return array
     */
    public function getNew($new_num)
    {
        $key = substr($new_num , 4);
        $key_next = $key+1;
        $key_pre = $key-1;
        $double = [
            $this -> makeDouble($key_next),
            $this -> makeDouble($key),
        ];
        if($key_pre > 0)
        {
            $double[] = $this -> makeDouble($key_pre);
        }
        return $double;
    }

    public function makeDouble($key)
    {
        $doubleModel = D('double');
        $list = $this
                    -> where('`num` LIKE "%' . $key . '"')
                    -> order('`num` DESC')
                    -> select();

        $count = count($list);
        $new_reds = [];
        for($i = 1 ; $i <= 6 ; $i++)
        {
            $red = $list[mt_rand(0 , ($count-1))]['red' . $i];
            if(in_array($red , $new_reds))
            {
                $red++;
            }
            if($red < 10){
                $red = strval( 0 . $red);
            }
            $new_reds['red' . $i] = $red;
        }
        sort($new_reds);
        $new_double = [
            'red' => $new_reds,
            'blue' => $list[mt_rand(0 , ($count-1))]['blue'],
        ];
        return $new_double;


    }


    /**
     * 新红色
     * @param array $red
     */
    public function makeRed2($red = [])
    {
        $onered = rand(1 , 33);
        if(!in_array($onered , $red))
        {
            $red[] = $onered;
        }
        if(count($red) >= 6)
        {
            sort($red);
            $this -> red_balls = $red;
        }else{
            $this -> makeRed2($red);
        }
    }

    /**
     * 新蓝色
     */
    public function makeBlue()
    {
        $blue = rand(1 , 16);
        $this -> blue_ball = $blue;
    }

    /**
     * 获取列表
     * @return mixed
     */
    public function getAll($page = 0)
    {
        $key = 'double_' . $page;
//        S($key , null);
        $allDouble = S($key);
        if(!$allDouble)
        {
            if($page > 0)
            {
                $double = $this
                    -> where('1=1')
                    -> page($page , self::$page_size)
                    -> order('num desc')
                    -> select();
            }else{
                $double = $this
                    -> where('1=1')
                    -> order('num desc')
                    -> select();
            }
            $allDouble = [];
            foreach($double as $key => $value)
            {
                $allDouble[$key]['num'] = $value['num'];
                $date = mktime(0 , 0 , 0 , $value['month'] , $value['day'] , $value['year']);
                $allDouble[$key]['date'] = date("Y-m-d" , $date);
                $allDouble[$key]['red'] = [
                    1 => $value['red1'],
                    2 => $value['red2'],
                    3 => $value['red3'],
                    4 => $value['red4'],
                    5 => $value['red5'],
                    6 => $value['red6'],
                ];
                $allDouble[$key]['blue'] = $value['blue'];
                $allDouble[$key]['prize_count'] = $value['prize_count'];
            }

            S($key , $allDouble);
        }
        return $allDouble;
    }

    /**
     * 分页字符
     * @param int $page
     * @return string
     */
    public function getPageStr($page = 1)
    {
        $page_count = $this -> where('1=1') -> count();
        $page = new \Think\Page($page_count,self::$page_size);
        $show = $page -> show();
        return $show;
    }

    /**
     * 获取网页上的记录
     * @param $page
     * @return array
     */
    public function getContent($page)
    {
        $page = intval($page);
        if($page <= 1){
            $page = 1;
        }
        //拼接地址
        $url = $this -> makePageUrl($page);
        //获取网页内容
        $page_content = $this -> getPageContent($url);
        //根据内容，筛出数据
        $array_content = $this -> getArray($page_content);
        return $array_content;
    }

    public function makePageUrl($page)
    {
        $tail = '.html';
        $url = substr(self::$base_url , 0 , -strlen($tail)) . '_' . $page . $tail;
        return $url;

    }

    public function getPageContent($url)
    {
        $content = file_get_contents($url);
        return $content;
    }

    public function getArray($content)
    {
        $pattern_date = "/center\">(\d{4}-\d{2}-\d{2})/";
        $pattern_num = "/center\">(\d{7})/";
        $pattern_red = "/class=\"rr\">(\d{2})<\/em>/";
        $pattern_blue = "/em>(\d{1,2})<\/em>/";
        $pattern_count = "/strong>(\d{1,2})<\/strong/";
        preg_match_all($pattern_date , $content , $arr_date);
        preg_match_all($pattern_num , $content , $arr_num);
        preg_match_all($pattern_red , $content , $arr_red);
        preg_match_all($pattern_blue , $content , $arr_blue);
        preg_match_all($pattern_count , $content , $arr_count);

        $arr_num = $arr_num[1];
        $arr_content = [];
        foreach($arr_num as $key => $value)
        {
            $arr_content[$key]['num'] = $value;
            //开奖日期
            $data = explode('-' , $arr_date[1][$key]);
            $arr_content[$key]['year'] = $data[0];
            $arr_content[$key]['month'] = $data[1];
            $arr_content[$key]['day'] = $data[2];
            //红球
            $base_index = $key*6;
            for($i = 0 ; $i < 6 ; $i ++)
            {
                $arr_content[$key]['red' . ($i+1)] = $arr_red[1][($base_index+$i)];
            }
            //篮球
            $arr_content[$key]['blue'] = $arr_blue[1][$key];
            //一等奖中奖数
            $arr_content[$key]['prize_count'] = $arr_count[1][$key];
        }
        return $arr_content;
    }
}