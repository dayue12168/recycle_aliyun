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
    public function authorize()
    {
        global $server;
        $dsn = 'mysql:dbname=recycle;host=rm-uf6qd1p0j4dv12t59vo.mysql.rds.aliyuncs.com';
        $username = 'recycle_admin';
        $password = 'QWER!@#$%4321';
        Autoloader::register();
        // $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
        $storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

        // Pass a storage object or array of storage objects to the OAuth2 server class
        $server = new \OAuth2\Server($storage);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));


        $request = \OAuth2\Request::createFromGlobals();
        $response = new \OAuth2\Response();
        // echo '<pre/>';
        // var_dump($response);die('aaa');
        // validate the authorize request
        if (!$server->validateAuthorizeRequest($request, $response)) {

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
            exit("SUCCESS! Authorization Code: $code");
        }
        $response->send();
    }
}