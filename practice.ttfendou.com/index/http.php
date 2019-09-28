<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/4/16 23:15
 */
header("Content-type: text/html; charset=gb2312");
interface Proto
{
    //链接url
    function conn($url);
    //发送get请求
    function get();
    //发送post请求
    function post();
    //关闭链接
    function close();
}

class Http implements Proto
{

    const CRLF = "\r\n";
    protected $url = [];
    protected $default_port = '80';
    protected $header = [];
    protected $line = [];
    protected $body = [];
    protected $version = 'HTTP/1.1';
    protected $fh = null;
    protected $response = '';    //返回信息

    protected $errono = null;   //错误编号
    protected $errostr = '';    //错误信息
    protected $timeout = 3;    //超时时间

    public function __construct($url)
    {
        $this -> conn($url);
        $this -> setHeader("Host: " . $this -> url['host']);
        if(!isset($url['port']))
        {
            $this -> url['port'] = $this -> default_port;
        }

    }

    //请求行 ： GET /xxxx/xxxx.html HTTP/1.1
    protected function setLine($method)
    {
        $this -> line[0] = $method . ' ' . $this -> url['path'] . ' ' . $this -> version;
    }
    //头信息： Host: www.xxxx.com
    public function setHeader($headerline)
    {
        $this -> header[] = $headerline;
    }
    //主体
    public function setBody()
    {

    }
    public function conn($url)
    {
        // TODO: Implement conn() method.
        $this -> url = parse_url($url);
    }

    public function get()
    {
        // TODO: Implement get() method.
        $this -> setLine('GET');
        $this -> query();
        var_dump($this -> response);
        return $this -> response;
    }

    public function post()
    {
        // TODO: Implement post() method.
    }
    public function query()
    {
        $this -> fh = fsockopen($this -> url['host'] , $this -> url['port'] , $this -> errono , $this -> errostr , $this -> timeout);
        $req = array_merge($this -> line , $this -> header , [''] , $this -> body , ['']);
        $req = implode(self::CRLF , $req);
        fwrite($this -> fh , $req);

        while(!feof($this -> fh))
        {
            $this -> response .= fread($this -> fh , 1024);
        }
        $this -> close();
    }
    public function close()
    {
        // TODO: Implement close() method.
    }
}

$url = 'http://tech.163.com/18/0416/07/DFGDP7FO00097U7T.html';
$http = new Http($url);
echo $http -> get();
//print_r($http);