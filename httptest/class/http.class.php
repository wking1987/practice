<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/3
 * Time: 15:01
 */


//http 请求类的接口
interface Proto{
    function connect($url);

    public function get($data);

    public function post($data);

    public function close();
}


class HttpSock implements Proto{
    protected $url = [];
    protected $version ='HTTP/1.1';
    protected $line = [];
    protected $header = [];
    protected $body = [];
    protected $body_str = '';
    public $query = '';
    protected $fh = null;
    protected $errorno = -1;
    protected $errorstr = '';
    protected $respons = '';
    protected $res_line = [];
    protected $res_header = [];
    protected $res_content = '';
    protected $res_type = '';
    protected $res_length = '';
    const CRLF = "\r\n";
    const DEFAULT_PORT = 80;
    const OUT_TIME = 30;
    //每次读取文件长度
    const CONTENT_FOOT = 2048;
    //文件类型
    protected $res_types = [
        'text' => [
            'plain' => 'txt',
            'html' => 'html',
        ],
        'image' => [
            'jpeg' => 'jpg',
            'png' => 'png',
        ],
    ];

    public function __construct($url){
        //打开链接
        $this->connect($url);
        //设置头信息
        $this->setHeader(['Host' => $this->url['host']]);
        return $this;
    }

    /**
     * 此方法负责写请求行：包括请求方式（GET/POST)，请求路径和请求协议
     * @param $method
     */
    protected function setLine($method){
        $query = $this->query ? '?' . $this->query : '';
        $this->line = [$method . ' ' . $this->url['path'] . $query . ' ' . $this->version];
    }

    /**
     * 此方法负责写头信息
     * @param $headerline
     */
    public function setHeader($headerline){
        foreach($headerline as $key => $value){
            $this->header[] = $key . ': ' . $value;
        }
    }

    /**
     *  设置返回值的状态行
     * @param string $line
     */
    protected function setResLine($line){
        $line = trim($line);
        $line = explode(" " , $line);
        $this->res_line['version'] = $line[0];
        $this->res_line['status'] = $line[1];
        $this->res_line['msg'] = $line[2];
    }

    /**
     *  读取返回数据的状态行
     * @return array
     */
    public function getResLine(){
        return $this->res_line;
    }

    /**
     *  设置返回值的头信息，并设置返回的内容长度和内容格式
     * @param $header
     */
    protected function setResHeader($key , $value){
        $key = trim($key);
        $value = trim($value);
        $this->res_header[$key] = $value;
        if(strtolower($key) == 'content-length'){
            $this->res_length = intval($value);
        }
        if(strtolower($key) == 'content-type'){
            $type = explode("/" , $value);
            if(strpos($type[1] , ';')){
                $type[1] = substr($type[1] , 0 , strpos($type[1] , ';'));
            }
            if(isset($this->res_types[$type[0]][$type[1]])){
                $this->res_type = $this->res_types[$type[0]][$type[1]];
            }else{
                $this->res_type = $type[1];
            }
        }
    }

    /**
     *  返回读取内容的头信息
     * @param string $key
     * @return array|mixed
     */
    public function getResHeader($key = ''){
        if($key != '')
            return $this->res_header[$key];
        return $this->res_header;
    }

    /**
     *  返回读取数据的文件类型，用于本地保存文件
     * @return string
     */
    public function getResType(){
        return $this->res_type;
    }


    /**
     *  设置读取内容
     * @param string $content
     */
    protected function setResContent($content)
    {
        $this->res_content .= $content;
    }

    /**
     *  返回读取的内容
     * @return string
     */
    public function getResContent(){
        return $this->res_content;
    }
    /**
     * 此方法负责写主体信息
     * @param $body
     */
    protected function setBody($body){
        $body_str = http_build_query($body);
        $this->body = [$body_str];
    }

    /**
     *  打开链接
     * @param $url
     */
    public function connect($url){
        $this->url = parse_url($url);
        $this->url['port'] = isset($this->url['port']) ? $this->url['port'] : self::DEFAULT_PORT;
        //设置query
        if(isset($this->url['query'])){
            $this->query = trim($this->url['query']);
        }
        //端口号需要判断设置
        try{
            $this->fh = fsockopen($this->url['host'] , $this->url['port'] , $errorno , $this->errorstr , self::OUT_TIME);
        }catch (Exception $e){
            echo 'Message: ' . $e ->getMessage();
        }
    }

    /**
     * 构造get请求的数据
     * @param array $data
     * @return string
     */
    public function get($data = []){
        if(!empty($data)) {
            //get方式有发送数据，拼装query
            $query = http_build_query($data);
            $this->query = empty($this->query) ? $query : ($this->query . '&' . $query);
        }
        $this->setLine('GET');
        $this->request();
        return $this->res_content;
    }
    /**
     * 构造post请求的数据
     * @param $data
     * @return string
     */
    public function post($data){
        $this->setBody($data);
        $header = [
            'Content-type' => 'application/x-www-form-urlencoded',
            'Content-length' => strlen(reset($this->body))
        ];
        $this->setLine('POST');
        $this->setHeader($header);
        $this->request();
        return $this->res_content;
    }

    /**
     *  执行请求
     * @return string
     */
    protected function request(){
        //把请求行、头信息、实体信息，放在一个数组里，便于拼接
        $req = array_merge($this->line , $this->header , [''] , $this->body , ['']);
        $req = implode(self::CRLF , $req);
        fwrite($this->fh , $req);
        $is_content = false;
        $is_line = true;
        $loop = true;
        $content_length = 0;
        $content_foot = self::CONTENT_FOOT;
        do{
            //返回内容设置
            if($is_content){
                if($this->res_length <= 0){
                    $loop = false;
                    continue;
                }
                //判断是否到了文件末尾
                if($content_length + $content_foot >= $this->res_length) {
                    $content_foot = $this->res_length - $content_length;
                    $loop = false;
                }
                $res = fread($this->fh , $content_foot);
                $content_length += $content_foot;
                $this->setResContent($res);
                continue;
            }
            //返回内容的状态和头信息设置
            $res = fgets($this->fh);
            //返回内容的状态行
            if($is_line){
                $this->setResLine($res);
                $is_line = false;
                continue;
            }

            //如果该行内容为空，则下边开始为返回的内容
            if(trim($res) == '') {
                $is_content = true;
                continue;
            }
            //返回内容的头信息
            $header_key = substr($res , 0 , strpos($res , ": "));
            $header_value = substr($res , strpos($res , ": ")+2);
            $this->setResHeader($header_key , $header_value);
        }while($loop);
        return $this->res_content;
    }

    /**
     *  关闭了服务连接
     */
    public function close(){
        fclose($this->fh);
    }
    public function __destruct()
    {
        $this->close();
    }
}

