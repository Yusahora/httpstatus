<?php
namespace controllers\publics;

use \controllers\internals\Api as InternalApi;
use \ApiController as ApiController;
use \Model as Model;

class Api extends \Controller
{
    public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_api = new InternalApi($pdo);
        $this->controller_api = new ApiController($pdo);
        $this->model_api = new Model($pdo);
    }

    public function home ()
    {
        $key_user = $_GET['api_key'] ?? false;
        $api_key = "abcdefghjaimelesapis";
        if($key_user == $api_key){
             return $this->controller_api->json(array(
            'version' => 1,
            'list' => $_SERVER['SERVER_NAME'].'/httpstatus/api/list/'

        ));
        }
        else {
            return $this->controller_api->json(array(
                'success' => false,
                'api_key' => 'Not valid'
            ));
        }
       
    }
    public function list() {
        $key_user = $_GET['api_key'] ?? false;
        $api_key = "abcdefghjaimelesapis";
        if($key_user == $api_key){
            $sites = $this->internal_api->get_list();

            $websites = array();

            foreach($sites as $key => $site){
                $array_site = [
                    'id' => $site['id'],
                    'url' => $site['url_site'],
                    'delete' => $_SERVER['SERVER_NAME'].'/Httpstatus/api/delete/'.$site['id'],
                    'status' => $_SERVER['SERVER_NAME'].'/Httpstatus/api/status/'.$site['id'],
                    'history' => $_SERVER['SERVER_NAME'].'/Httpstatus/api/history/'.$site['id']
                ];
                array_push($websites, $array_site);
            }

            return $this->controller_api->json(array(
                'version' => 1,
                'websites' => $websites

            ));
    }
    else {
        return $this->controller_api->json(array(
            'success' => false,
            'api_key' => 'Not valid'
        ));
    }
    }
    public function add(){
        $key_user = $_GET['api_key'] ?? false;
        $api_key = "abcdefghjaimelesapis";
        $url_site = htmlspecialchars($_POST['url_site']);
        

        if($key_user == $api_key){
                $add = $this->internal_api->addSite($url_site);
                $id = $this->model_api->last_id();

                if($add && isset($url_site) && !empty($url_site))
                {
                    return $this->controller_api->json(array(
                        'success' => true,
                        'id' => $id,
                    ));
                }
    }
}
public function delete(int $id){
    $key_user = $_GET['api_key'] ?? false;
        $api_key = "abcdefghjaimelesapis";
        if($key_user == $api_key){
            $deleteSite = $this->internal_api->deleteSite($id);
            
            if($deleteSite)
            {
                return $this->controller_api->json(array(
                    'success' => true,
                    'id' => $id
                ));
            }
            else
            {
                return $this->controller_api->json(array(
                    'success' => false,
                    'id' => 'ID not valid'
                ));
            }
        }
        }
}

