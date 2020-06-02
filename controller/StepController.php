<?php

use Framework\Configuration;
use Framework\Controller\Controller;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\View;

class StepController extends Controller
{

    private $stepDao;

    public function __construct()
    {
        $this->stepDao = new StepDao();
    }



    public function delete(Request $request)  {
        
        $post = $request->request();
        $id = intval($post->get('id'));
        $this->stepDao->deleteStepByStepId($id);

        return Response::json(["success" => true]); 
    }

}     