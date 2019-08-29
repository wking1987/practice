<?php
class SuanfaClass
{

    /**
     * 冒泡排序之从大到小排序
     * @param $arr
     * @param $sort
     * @return array
     */
    public function zhijie($arr , $sort = 'desc')
    {
        $arr_sort = [];
        while(count($arr) > 0)
        {
            $tmpValue = false;
            $tmpKey = false;
            foreach($arr as $key => $value){
                if($sort == 'desc')
                {
                    if($tmpValue === false || $value > $tmpValue)
                    {
                        $tmpValue = $value;
                        $tmpKey = $key;
                    }
                }else{
                    if($tmpValue === false || $value < $tmpValue)
                    {
                        $tmpValue = $value;
                        $tmpKey = $key;
                    }
                }

            }
            $arr_sort[] = $tmpValue;
            unset($arr[$tmpKey]);
        }
        return $arr_sort;
    }


    /**
     * 冒泡排序
     * @param $arr
     * @param string $sort
     * @return mixed
     */
    public function maopao($arr , $sort = 'desc')
    {
        $length = count($arr);
        for($i = $length; $i >= 1 ; $i--)
        {
            $tmpValue = false;
            $tmpKey = false;
            $j = 1;
            foreach($arr as $key => $value)
            {
                if($j > $i)break;
                if($tmpKey !== false)
                {
                    if($sort == 'desc')
                    {
                        if($value > $arr[$tmpKey])
                        {
                            $tmpValue = $arr[$tmpKey];
                            $arr[$tmpKey] = $value;
                            $arr[$key] = $tmpValue;
                        }
                    }else{
                        if($value < $arr[$tmpKey])
                        {
                            $tmpValue = $arr[$tmpKey];
                            $arr[$tmpKey] = $value;
                            $arr[$key] = $tmpValue;
                        }
                    }

                }
                $tmpKey = $key;
                $j++;
            }
        }

        return $arr;
    }
}