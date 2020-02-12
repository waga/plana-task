<?php

namespace Controller;

use Exception;
use App\Controller;
use App\Config;
use App\Http\Client as HttpClient;
use App\Http\Request as HttpRequest;
use App\Http\Response as HttpResponse;
use App\ArrayDot;
use App\Database;
use Validator\APIAddFormValidator;
use App\Router;

class Api extends Controller
{
    public function index(
        HttpClient $client, 
        HttpRequest $request, 
        Config $config, 
        ArrayDot $arrayDot, 
        Database $database)
    {
        $this->view = false;
        $this->layout = false;
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Method: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With');
        
        if ($_POST) {
            
            if (!array_key_exists('address', $_POST) || !$_POST['address']) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Missing address parameter!'
                ));
                return;
            }
            
            $apis = $database->query('SELECT * FROM `apis`');
            $address = $_POST['address'];
            $data = array();
            $request->setHeader('User-Agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            
            foreach ($apis as $api) {
                
                try
                {
                    $apiUrl = sprintf($api['url'], urlencode($address));
                    $request->setUrl($apiUrl);
                    
                    $response = $client->request($request);
                    $response = json_decode($response->getBody(), true);
                    
                    $arrayDot->setArray($response);
                    $responseResults = $arrayDot->dot(
                        $api['response_results_accessor'], $response);
                    
                    $results = array();
                    foreach ($responseResults as $result) {
                        
                        $arrayDot->setArray($result);
                        
                        $lat = $arrayDot->dot(
                            $api['response_row_lat_accessor'], array());
                        $lng = $arrayDot->dot(
                            $api['response_row_lng_accessor'], array());
                        
                        $results[] = array(
                            'lat' => $lat,
                            'lng' => $lng,
                        );
                    }
                    
                    $data[] = array(
                        'name' => $api['name'],
                        'title' => $api['title'],
                        'results' => $results,
                    );
                }
                catch (Exception $e)
                {
                    $data[] = array(
                        'name' => $api['name'],
                        'title' => $api['title'],
                        'results' => array(),
                        'error' => $e->getMessage()
                    );
                }
            }
            
            $response = array(
                'status' => 'success',
                'data' => $data
            );
            echo json_encode($response);
            return;
        }
    }
    
    public function list(Database $database)
    {
        return array('apis' => $database->query('SELECT * FROM `apis`'));
    }
    
    public function add(APIAddFormValidator $validator, 
        Database $database)
    {
        $this->view = 'api/edit';
        $headAction = 'Add';
        $formAction = 'add';
        
        if ($_POST) {
            
            if (!$validator->validate($_POST)) {
                return array(
                    'headAction' => $headAction, 
                    'formAction' => $formAction, 
                    'errors' => $validator->getErrors(),
                    'formData' => $_POST
                );
            } else {
                $apiId = $database->insert('apis', array(
                    'name' => $_POST['name'],
                    'title' => $_POST['title'],
                    'url' => $_POST['url'],
                    'response_results_accessor' => $_POST['response_results_accessor'],
                    'response_row_lat_accessor' => $_POST['response_row_lat_accessor'],
                    'response_row_lng_accessor' => $_POST['response_row_lng_accessor'],
                ));
                if (!$apiId) {
                    return array(
                        'headAction' => $headAction, 
                        'formAction' => $formAction, 
                        'errors' => array('Failed to save API to database'),
                        'formData' => $_POST
                    );
                }
                $this->redirect('/ui/api/list');
                return;
            }
            
        }
        
        return array(
            'headAction' => $headAction,
            'formAction' => $formAction,
        );
    }
    
    public function edit(Router $router, Database $database)
    {
        $urlParams = $router->getUrlParams();
        $headAction = 'Edit';
        
        $id = (int) $urlParams['id'];
        $api = $database->query('SELECT * FROM `apis` WHERE id = ?', array($id));
        
        if (!$api) {
            throw new Exception('API not found');
        }
        
        $formAction = 'edit/'. $id;
        $api = $api[0];
        
        if ($_POST) {
            $database->query('
                UPDATE `apis` SET 
                    name = ?, 
                    title = ?, 
                    url = ?, 
                    response_results_accessor = ?, 
                    response_row_lat_accessor = ?, 
                    response_row_lng_accessor = ? 
                WHERE id = ?', array(
                $_POST['name'],
                $_POST['title'],
                $_POST['url'],
                $_POST['response_results_accessor'],
                $_POST['response_row_lat_accessor'],
                $_POST['response_row_lng_accessor'],
                $id
            ));
            $this->redirect('/ui/api/list');
            return;
        }
        
        return array(
            'headAction' => $headAction,
            'formAction' => $formAction,
            'formData' => $api
        );
    }
    
    public function delete(Router $router, Database $database)
    {
        $this->view = false;
        $this->layout = false;
        
        $urlParams = $router->getUrlParams();
        
        $id = (int) $urlParams['id'];
        $api = $database->query('SELECT * FROM `apis` WHERE id = ?', array($id));
        
        if (!$api) {
            throw new Exception('API not found');
        }
        
        $database->query('DELETE FROM `apis` WHERE id = ?', array($id));
        $this->redirect('/ui/api/list');
    }
}
