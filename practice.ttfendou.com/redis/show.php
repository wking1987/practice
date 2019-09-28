<?php
use lib\LibConnectClass;
use lib\LibGoodsClass;
include_once __DIR__ . '/common/Construct.php';
?>
<html>
<head></head>
<body>

<?php
$getName = trim($_GET['name']);
if($_GET['name'] == ''){
?>
    <form action="/redis/show.php" method="get">
    <p>请输入姓名</p>
    <input type="text" name="name" value=""/><br/>
    <input type="submit" value="确定">
    </form>
<?php
    return;
}
$redisObj = LibConnectClass::getinstance();

$userExists = $redisObj -> exists($getName);
if($userExists == false){
    $status = '您还没有抢购';
}else{
    $myStatus = $redisObj -> get($getName);
    if($myStatus == 'waite'){
        $status = '正在排队中！';
    }elseif($myStatus == 'ok')
    {
        $status = '抢购成功！';
    }else{
        $status = '抢购失败！';
    }
}

//检查name是否已存在
$dataOpen = [
    'type' => 'open',
    'name' => $getName,
];
$dataOpenJson = json_encode($dataOpen);

$dataQiang = [
    'type' => 'qiang',
    'name' => $getName,
];
$dataQiangJson = json_encode($dataQiang);

$dataLook = [
    'type' => 'look',
    'name' => $getName,
];
$dataLookJson = json_encode($dataLook);
//不抢了
$dataLeave = [
    'type' => 'leave',
    'name' => $getName,
];
$dataLeaveJson = json_encode($dataLeave);
?>


<div id="content" style="width:1000px;height:auto;margin:0 auto;border:1px solid #ff0000">
    <p>show things</p>
    <p><?php echo $status;?></p>
</div>
<input type="button" value="抢购" id="qiang" />
<input type="button" value="看结果" id="look" />
<input type="button" value="不抢了" id="leave" />
</body>
</html>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    var ws = new WebSocket('ws://101.132.24.196:2345');
    var openJson = '<?php echo $dataOpenJson; ?>';
    var qiangJson = '<?php echo $dataQiangJson; ?>';
    var lookJson = '<?php echo $dataLookJson; ?>';
    var leaveJson = '<?php echo $dataLeaveJson; ?>';
    ws.onopen = function(){
        ws.send(openJson);
    };
    $("#qiang").bind('click' , function(){
        ws.send(qiangJson);
    })
    $("#look").bind('click' , function(){
        ws.send(lookJson);
    })
    $("#leave").bind('click' , function(){
        ws.send(leaveJson);
    })
    ws.onmessage = function(e){
        $("#content").append('<p>'+ e.data +'<p>')
    };
</script>