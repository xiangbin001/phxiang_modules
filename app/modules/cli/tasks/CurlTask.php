<?php
namespace Phxiang_modules\Modules\Cli\Tasks;

use Phxiang_modules\Modules\Cli\Tasks\CurlInit;

class CurlTasK extends \Phalcon\Cli\Task
{
	public $url = "https://phxiang_modules.com/";
	public $type = "GET";
	public $params = null;
	public $header = null;

    /**
     * 执行方式 
     * php run Curl c_add ，参数可以不用管
     */
    public function c_addAction(array $params)
    {

$url = 'https://phxiang_modules.com';
$data = [
	'name' => '浙江微元信息科技有限公司',
	'legal'=> 'xiangbin',
	'time' => '2016-01-01',
];
$header = [
	// "Content-Type: text/xml; charset=utf-8", 
];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
$result = curl_exec($ch);
var_dump($result);exit();



    	// $curl = new CurlInit();
    	// $re = $curl->sss("https://phxiang_modules.com/", "GET", null,null);
    	// var_dump($re);exit();
    }
}


