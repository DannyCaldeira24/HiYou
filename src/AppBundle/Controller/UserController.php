<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use BackendBundle\Entity\User;
use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;

class UserController extends Controller {

    public function loginAction(Request $request) {
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('AppBundle:User:login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error
        ));
    }

    public function registerAction(Request $request) {
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                //$user_repo=$em->getRepository("BackendBundle:User");
                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                        ->setParameter('email', $form->get("email")->getData())
                        ->setParameter('nick', $form->get("nick")->getData());
                $user_isset = $query->getResult();
                if (count($user_isset) == 0) {
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);

                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());

                    $user->setPassword($password);
                    $user->setRole("ROLE_USER");
                    $user->setImage(null);

                    $em->persist($user);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Te has registrado correctamente";
                        $session = $request->getSession();
                        $session->getFlashBag()->add("status", $status);
                        return $this->redirect("login");
                    } else {
                        $status = "No te has registrado correctamente";
                    }
                } else {
                    $status = "El usuario ya existe !!";
                }
            } else {
                $status = "No te has registrado correctamente !!";
            }
            $session = $request->getSession();
            $session->getFlashBag()->add("error", $status);
        }
        return $this->render('AppBundle:User:register.html.twig', array("form" => $form->createView()));
    }

    public function nickTestAction(Request $request) {
        //Comprobar si el nick del usuario que se quiere registrar ya existe en tiempo real
        $nick = $request->get("nick");
        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository("BackendBundle:User");
        $user_isset = $user_repo->findOneBy(array("nick" => $nick));

        $result = "used";
        if (is_object($user_isset)) {
            $result = "used";
        } else {
            $result = "unused";
        }
        return new Response($result);
    }
    public function emailTestAction(Request $request) {
        //Comprobar si el nick del usuario que se quiere registrar ya existe en tiempo real
        $email = $request->get("email");
        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository("BackendBundle:User");
        $user_isset = $user_repo->findOneBy(array("email" => $email));

        $result = "used";
        if (is_object($user_isset)) {
            $result = "used";
        } else {
            $result = "unused";
        }
        return new Response($result);
    }

    public function editUserAction(Request $request) {

        $user = $this->getUser();
        $user_image=$user->getImage();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
   
                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                        ->setParameter('email', $form->get("email")->getData())
                        ->setParameter('nick', $form->get("nick")->getData());
                $user_isset = $query->getResult();
                if (($user->getEmail() == $user_isset[0]->getEmail() && $user->getNick() == $user_isset[0]->getNick()) || count($user_isset) == 0) {
                    
                    //subiendo archivo
                    $file = $form["image"]->getData();
                    if(!empty($file) && $file !=null){
                       $ext=$file->guessExtension();
                       if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                           $file_name = $user->getId().time().'.'.$ext;
                           $file->move("uploads/users",$file_name);
                           
                           $user->setImage($file_name);
                           
                       }
                    }else{
                        $user->setImage($user_image);
                    }

                    $em->persist($user);
                    $flush = $em->flush();

                    if ($flush == null) {
                        $status = "Has modificado tus datos correctamente";
                        $session = $request->getSession();
                        $session->getFlashBag()->add("status", $status);
                        return $this->redirect('my-data');
                    } else {
                        $status = "No has modificado tus datos correctamente";
                    }
                } else {
                    $status = "El nick o email ya existe !!";
                }
            } else {
                $status = "No se han actualizado tus datos correctamente !!";
            }
            $session = $request->getSession();
            $session->getFlashBag()->add("error", $status);
            return $this->redirect('my-data');
        }
        return $this->render('AppBundle:User:edit_user.html.twig', array(
                    "form" => $form->createView()
        ));
    }

}
