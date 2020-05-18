<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Request;
use Framework\View;

class UserController extends Controller {

    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function insert() {
        
    }


    public function delete(Request $request) {
        $post = $request->request();
        $id = $post->get('id');

        if($this->userDao->deleteUserById($id)) echo json_encode(array("message" => "ok"));

    }   
    
    
}      
    