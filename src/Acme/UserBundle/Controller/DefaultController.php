<?php

namespace Acme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();

        return $this->render('AcmeUserBundle:Default:welcome.html.twig', array('pic'=> $pic));
    }

    public function startAction()
    {
        return $this->render('AcmeUserBundle:Default:start.html.twig');
    }
}
