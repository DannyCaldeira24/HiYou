<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends Controller{
    public function indexAction(Request $request){
        echo "Acción index publicatión";
        die();
    }
}
