<?php
// echo json_encode(getallheaders());

// print_r($_SERVER);//超全局变量获取请求源所有数据，其中带有HTTP_开头的是请求头数据
// print_r($_ENV);exit();
// $GLOBALS
// $_SERVER
// $_GET  	//当请求是GET时获取所有的get请求数据，仅请求体
// $_POST   //当请求是POST时获取所有的post请求数据，仅请求体
// $_FILES	
// $_COOKIE  
// $_SESSION
// $_REQUEST  //可以获取所以请求中请求体的数据，(但是速度较慢?)
// $_ENV 	//获取服务器的环境，一般为空，在php.ini中 variables_order = "GPCS" 改成variables_order = "EGPCS" ，即可看到服务器信息




// $data = file_get_contents('php://input', 'r'); //获取post数据 php://input不能用于enctype=multipart/form-data”
// Content-Type:multipart/form-data; boundary=ZnGpDtePMx0KrHh_G0X99Yef9r8JZsRJSXC
// enctype=multipart/form-data当请求头里出现这个东西时,说明数据是通过二进制流传送的,这个时候php://input时获取不到数据的

// $a = getallheaders();//获取客户端请求头
// print_r($a);exit();
// exit();

// $url = 'http://www.baidu.com';
// $a = get_headers($url, 1);
// print_r($a); //获取服务端响应头
//exit();

if (!empty($argc)) {
    require '../app/bootstrap_cli.php';
} else {
    require '../app/bootstrap_web.php';

}
