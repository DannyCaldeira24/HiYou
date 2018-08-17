<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use BackendBundle\Entity\User;
use AppBundle\Form\RegisterType;

class UserController extends Controller
{
    public function loginAction(Request $request){
        return $this->render('AppBundle:User:login.html.twig', array("titulo"=>"Login"));
    }
    
    public function registerAction(Request $request){
        $user=new User();
        $form=$this->createForm(RegisterType::class,$user);
        return $this->render('AppBundle:User:register.html.twig', array("form"=>$form->createView()));
    }
}
