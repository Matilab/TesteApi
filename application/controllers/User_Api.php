<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/API_Controller.php';

class User_Api extends API_Controller
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * limit method 
     *
     * @link [api/user/limit]
     * @method POST
     * @return Response|void
     */
    public function limit()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            'limit' => [5, 'ip', 5],
        ]);
        
        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => "Return API Response",
            ],
        200);
    }

    /**
     * Check API Key
     *
     * @return key|string
     */
    private function key()
    {
        // use database query for get valid key

        return 1452;
    }


    /**
     * login method 
     *
     * @link [api/user/login]
     * @method POST
     * @return Response|void
     */
    public function login()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
        ]);

        // you user authentication code will go here, you can compare the user with the database or whatever

        $data = $this->verify_login();
        if($data === True){
            $payload = [
                'id' => "Your User's ID",
                'other' => "Some other data",
                'email' => $_POST['email'],
                'senha' => $_POST['senha']
            ];    
        

        

            // Load Authorization Library or Load in autoload config file
            $this->load->library('authorization_token');

            // generate a token
            $token = $this->authorization_token->generateToken($payload);

            // return data
            $this->api_return(
                [
                    'status' => true,
                    "result" => [
                        'token' => $token,
                    ],
                    
                ],
            200);
        } else {
                    // API Configuration
            $this->_apiConfig([
                /**
                 * By Default Request Method `GET`
                 */
                'methods' => ['POST'], // 'GET', 'OPTIONS'

                /**
                 * Number limit, type limit, time limit (last minute)
                 */
                'limit' => [5, 'ip', 5],
            ]);
        
            $this->api_return(
                $data,
                401
            );
        }
    }

    /**
     * view method
     *
     * @link [api/user/view]
     * @method POST
     * @return Response|void
     */
    public function view()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);

        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'user_data' => $user_data['token_data']
                ],
            ],
        200);
    }

    private function verify_login(){
        $data = [];
        if ($_POST['email'] == 'matheusnarciso@hotmail.com'){
            if(md5($_POST['senha']) == md5('12345')){
                return true;
            } else {
                $data = [
                    'status' => false,
                    'result' => ['message' => 'Password does not match.']
                ];
            }
        } else {
            $data = [
                    'status' => false,
                    'result' => ['message' => 'E-mail not found.']
                ];
        }
        return $data;
    }
}