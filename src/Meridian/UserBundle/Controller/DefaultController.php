<?php

namespace Meridian\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();

        return $this->render('MeridianUserBundle:Default:welcome.html.twig', array('pic'=> $pic));
    }

    public function startAction()
    {
        return $this->render('MeridianUserBundle:Default:start.html.twig');
    }

    public function testAction()
    {
        return $this->render('MeridianUserBundle:Default:test.html.twig');
    }



}
