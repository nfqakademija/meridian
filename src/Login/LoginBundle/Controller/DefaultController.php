<?php

namespace Login\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Login\LoginBundle\Entity\Users;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        if($request->getMethod()=='POST') {
            $username=$request->get('username');
            $password=$request->get('password');
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('LoginLoginBundle:Users');

            $user = $repository->findOneBy(array('userName' => $username, 'password'=> $password));
            if ($user) {
                return $this->render('LoginLoginBundle:Default:welcome.html.twig', array('name' => $user-> getFirstName()));
            }
            else {
                return $this->render('LoginLoginBundle:Default:index.html.twig', array('name' => 'failed'));
            }
        }


        return $this->render('LoginLoginBundle:Default:index.html.twig');

    }

    public function signupAction(Request $request) {
        if($request->getMethod()=='POST'){
            $username=$request->get('username');
            $password=$request->get('password');
            $firstname=$request->get('firstname');

            $user = new Users();
            $user->setFirstname($firstname);
            $user->setPassword($password);
            $user->setUserName($username);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        }
        return $this->render('LoginLoginBundle:Default:signup.html.twig');
    }
}
