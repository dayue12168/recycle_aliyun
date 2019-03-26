<?php
/**
 * Created by PhpStorm.
 * User: dayue
 * Date: 2019/3/25
 * Time: 17:27
 */

namespace app\v1\controller;

use OAuth2\Autoloader;
use think\Controller;

class OAuth extends Controller
{

    public function _initialize()
    {
        Autoloader::register();
    }

    private function server()
    {
        $pdo = new \PDO('mysql:host=rm-uf6qd1p0j4dv12t59vo.mysql.rds.aliyuncs.com;dbname=recycle', "recycle_admin", "QWER!@#$%4321");

        //创建存储的方式
        $storage = new \OAuth2\Storage\Pdo($pdo);

        //创建server
        $server = new \OAuth2\Server($storage);

        // 添加 Authorization Code 授予类型
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));

        return $server;
    }
    public function authorize()
    {
        // global $server;
        // $dsn = 'mysql:dbname=recycle;host=rm-uf6qd1p0j4dv12t59vo.mysql.rds.aliyuncs.com';
        // $username = 'recycle_admin';
        // $password = 'QWER!@#$%4321';
        // Autoloader::register();
        // $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
        $server = $this->server();
        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        // echo '<pre/>';
        // var_dump($response);die('aaa');
        // validate the authorize request
        if (!$server->validateAuthorizeRequest($request, $response)) {
            $response->send();
            die;
        }

        // display an authorization form
        if (empty($_POST)) {
            exit('
        <form method="post">
          <label>Do You Authorize TestClient?</label><br />
          <input type="submit" name="authorized" value="yes">
          <input type="submit" name="authorized" value="no">
        </form>');
        }

        // print the authorization code if the user has authorized your client
        $is_authorized = ($_POST['authorized'] === 'yes');
        $server->handleAuthorizeRequest($request, $response, $is_authorized);
        if ($is_authorized) {
            // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
            $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=') + 5, 40);
            // exit("SUCCESS! Authorization Code: $code");
            echo $code;
        }
        $response->send();
    }


    // 生成并获取token
    public function token()
    {
        $server = $this->server();
        $server->handleTokenRequest(\OAuth2\Request::createFromGlobals())->send();
        exit();
    }

    // 客户端回调，来自server端的Location跳转到此
// 此处会携带上code和你自定义的state
    public function cb()
    {
        $request = \OAuth2\Request::createFromGlobals();
        $url = "http://localhost/token";
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $request->query('code'),
            'client_id' => 'testclient',
            'client_secret' => '123456',
            'redirect_uri' => 'http://localhost/cb'
        ];

        //todo 自定义的处理判断
        $state = $request->query('state');
        echo '<pre/>';
        var_dump($data);die('---');
        $response = Curl::ihttp_post($url, $data);
        if (is_error($response)) {
            var_dump($response);
        }

        var_dump($response['content']);
    }
}