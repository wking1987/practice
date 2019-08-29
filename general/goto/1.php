<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/3/30
 * Time: 10:09
 */


/*
 * $i = 1;
DF:
if($i >= 10)
{
    echo 'this is in ' . $i ."<br/>";
    return;
}else{
    $i ++;
    echo 'this is out ' . $i . '<br/>';
    goto DF;
}
*/
/*
//自增循环
$i = 1;
inloop:
if($i >= 5)
{
    echo 'this is >= 5<br/>';
    goto end;
}
echo 'this is in inloop ' . $i . '<br/>';
$i ++;
goto inloop;

end:
echo 'this is end';
*/

/*
//选择跳转
//起始数字
$i = 0;
START:
$i ++;
if($i >= 10)
{
    //只循环10-1次
    goto END;
}
//计算除以3的余数
$is_3 = $i%3;
//余数为0，能被3整除，跳转到输出能被3整除的内容
if($is_3 == 0)
{
    goto IS3;
}
//否则跳转到不能被3整除的内容
goto NOT3;
//能被3整除的内容
IS3:
echo $i . '能被3整除<br/>';
//继续循环
goto START;
//不能被3整除的内容
NOT3:
echo $i . '不能被3整除<br/>';
//返回到start继续循环
goto START;

//结束
END:
echo '结束，$i=' . $i;
*/

//循环中跳出
for($i = 1 ; $i <= 10 ; $i ++)
{
    if($i >= 3)
    {
        goto END;
    }
    echo '循环内$i=' . $i . '<br/>';
}
END:
echo '跳出了循环$i=' . $i;