<?php

namespace Phxiang_modules\Modules\Frontend\Controllers;

use Phxiang_modules\Modules\Frontend\Models\User;

class IndexController extends ControllerBase
{
    public function testAction()
    {
        $url = 'http://';
        $curl_data = "var1=60&var2=test";

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",           // handle all encodings
            CURLOPT_USERAGENT      => "spider",     // who am i
            CURLOPT_AUTOREFERER    => true,         // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
            CURLOPT_TIMEOUT        => 120,          // timeout on response
            CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
            CURLOPT_POST           => 1,            // i am sending post data
            CURLOPT_POSTFIELDS     => $curl_data,   // this are my post vars
            CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
            CURLOPT_SSL_VERIFYPEER => false,        //
            CURLOPT_VERBOSE        => 1             //
        ];
        $ch = curl_init($url);
        curl_setopt_array($ch,$options);
    }

    public function ssAction()
    {


        // foreach ($this->foreachs($a) as $kv) {
        //     var_dump($kv); 
        // }
        // foreach ($a as $key => $value) {
        //     var_dump([$key, $value]);
        // }

        var_dump(memory_get_usage());  //462432
        foreach ($this->xrange(1, 100, 1) as $number) {
            echo "$number ";
        }

        // 463272
        // foreach (range(1, 100) as $key => $value) {  
        //     var_dump(memory_get_usage()); //467416

        //     echo "\n";
        // }
                       
        //使用生成器  
        //不使用生成器

    }

    public function foreachs($a)
    {
        //生成器是对未形成结构的数据做生成
        //a已经是个结构了，所以无效
        foreach ($a as $key => $value) {
            yield [$key, $value];
        }
    }

    public function xrange($start, $limit, $step = 1) 
    {
        for ($i = $start; $i <= $limit; $i += $step) {
            var_dump(memory_get_usage());
            yield $i;
        }
    }
    

    // public function xrange($start, $end, $step = 1)
    // {  
    //     for ($i = $start; $i <= $end; $i += $step) {  
    //         yield $i;  
    //     }
    // }  



    public function curl_addAction()
    {
        $url = 'http://127.0.0.1:9200/table/auth';
        $data = [
            'name' => '项斌写的',
            'sex'  => 'male',
            'age'  => 13,
            'auth' => 'JKFdYHudJERBaf',
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
        $result = curl_exec($ch);
//        var_dump($result);
        $data = (json_decode($result, true));
//        var_dump($data);
        curl_close($ch);
    }

    //结构化查询 Query DSL
    public function curl_searchAction()
    {
        $url = 'http://127.0.0.1:9200/person/info/_search?pretty=true';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST,1);
        $data = [
            "query"     => [ 'bool'=>['must' => ['match'=> ['name'=>'项斌']]]],
//            "query"     => [ 'term'=>[['name'=>'项']]],
            "highlight" => [
                "require_field_match"=> false,
                "fields"             => [
                    'name'=>[
                        "pre_tags"           => [ "<br>" ],
                        "post_tags"          => [ "</br>" ],
                    ]]
            ],
            "from"=>0,
            "size"=>10,
            "sort"=>[],
//            "aggs"=>[] //聚合
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data, JSON_UNESCAPED_UNICODE));

//        $data = '{"query": {"bool": {"must":{"match": {"name":"项"}}}}}';
//        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        print_r($result);
        curl_close($ch);
        return [];
    }


    public function curl_deleteAction()
    {
        $config = [
            'url'    => 'http://localhost:9200/person',
            'type'   => 'DELETE',
            'params' => null,
            'header'  => null
        ];

        $ch = curl_init($config['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_exec($ch);
        curl_close($ch);
    }


    public function curl_updateAction()
    {
        //给定id的话好像和ADD的功能是一样的
    }

    public function indexAction()
    {

    }


    //简单查询
    public function easyAction()
    {


        // $manager = $this->modelsManager;
        // var_dump(phpinfo());exit();

        //        var_dump(nl2br("s\nb"));exit();
        // $user = User::find(1);
//        $user = User::findById(1);`
//        $user = User::findFirst(2);
//        $user = User::findFirstById(2);`
//        $user = User::findFirstByName('2');//error
        // $this->view->setVars([
        //     'a' => 1,
        //     'b' => 2,
        // ]);
    }

    //复合查询
    public function firstAction()
    {
        $this->view->setVars([
            'a' => 1,
            'b' => 2,
        ]);
        $user = User::findFirst();
        var_dump($user->getUseraddress()->toArray());
    }

    //phql,manager
    public function secondAction()
    {
        $manager = $this->modelsManager;
        $phql = "SELECT * FROM  Phxiang_modules\Modules\Frontend\Models\User WHERE id = :id: and name = :name:";
        $user = $manager->executeQuery($phql, ['id' => '1', 'name' => 'xiangbin']);
//        $phql = "SELECT * FROM  Phxiang_modules\Modules\Frontend\Models\User WHERE id = ?0 and name = ?1 ";
//        $user = $manager->executeQuery($phql, [1, 'xiangbin'])->toArray();
        var_dump($user->toArray());
    }

    //manager->builder
    public function thirdAction()
    {
        $query = $this->modelsManager->createBuilder();
        $list = $query->from('Phxiang_modules\Modules\Frontend\Models\User')
            ->columns('*')
            ->where('id = :id:', ['id' => 1])
//            ->orderBy('applicationLog.id DESC')
//            ->rightJoin('applicationLog', 'applicationLog.fid = family.id')
            ->getQuery()
            ->execute();

        var_dump($list->toArray());
    }

    //db
    public function forthAction()
    {
//        $this->getDI()->get('db')
    }

    public function getParaAction()
    {
        var_dump($this->request->getQuery());
        var_dump($this->request->get('uid'));
        exit();
    }

    public function uploadAction()
    {
        // Check if the user has uploaded files
        if ($this->request->hasFiles()) {

            // Print the real file names and sizes
            foreach ($this->request->getUploadedFiles() as $file) {

                // Print file details
                echo $file->getName(), " ", $file->getSize(), "\n";

                // Move the file into the application
                $file->moveTo('files/' . $file->getName());
            }
        }
    }

    public function test()
    {
        $ES = $this->container->get('Es');
        $data = [
            'hss'=>[
                'role_id' =>330702199401110134,
                'sex'=>2,
                'age'=>21,
                'address'=>'Zhejiang',
            ]
        ];
        try{
//            $re = $ES->view(1);
//            var_dump($re);exit();

//            $re = $ES->delete(3);
//            $re = $ES->add(2, $data);

//            $data = json_decode($data,true);
//            //json解析过程出错则不应该执行;
//            $this->checkError();
//            $re = $ES->search(2, $data);

            $re = $ES->update(2, json_encode($data));
        }catch (Exception $e) {
            echo $e;
        }
        var_dump($re);exit();
    }

    public function checkError()
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                break;
            case JSON_ERROR_DEPTH:
                echo ' - Maximum stack depth exceeded';
                exit();
                break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Underflow or the modes mismatch';
                exit();
                break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Unexpected control character found';
                exit();
                break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error, malformed JSON';
                exit();
                break;
            case JSON_ERROR_UTF8:
                echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                exit();
                break;
            default:
                echo ' - Unknown error';
                exit();
                break;
        }

        return true;
    }

}

