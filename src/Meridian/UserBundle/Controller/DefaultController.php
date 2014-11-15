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
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user != 'anon.'){
            return $this->redirect($this->generateUrl("welcome_page"));
        }
        return $this->render('MeridianUserBundle:Default:start.html.twig');
    }

    public function testAction()
    {
        return $this->render('MeridianUserBundle:Default:test.html.twig');
    }



}
