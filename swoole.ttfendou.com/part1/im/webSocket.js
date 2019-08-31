var msg = document.getElementById("msg");
var wsServer = 'ws://47.98.121.135:9501';
var webSocket = new WebSocket(wsServer);

webSocket.onopen = function (event) {
    console.log('链接成功');
};

webSocket.onmessage = function (event) {
    $("#msg").html($("#msg").html() + event.data + "<br/>");
    console.log('从服务器获取到的数据');
    console.log(event);
};

webSocket.onclose = function (event) {
    console.log('服务器拒绝');
};


function send_msg(){
    var message = document.getElementById('text').value;
    document.getElementById('text').value = '';
    webSocket.send(message);

};

function send_name(){
    var text = document.getElementById('myname').value;
    console.log('设置姓名为：' + text);
    webSocket.send('#name#' + text)
    var myTitle = document.getElementById("myTitle");
    myTitle.innerHTML = "IM " + text;
    alert('设置名字成功');
    var setName = document.getElementById('setName');
    setName.style.display = 'none';
    var send_msg = document.getElementById('send_msg');
    send_msg.style.display = 'block';
};