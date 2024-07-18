<?php

namespace app\controllers;
use app\core\Request;

class ContactController extends BaseController
{

    public function contact(){
        return $this->renderView('contact');
     }

    public function submitContact(Request $request){    
 
        $request->getBody();
       return 'We are handling contact';
    }

}