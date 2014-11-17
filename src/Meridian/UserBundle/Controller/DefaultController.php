<?php

namespace Meridian\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeridianUserBundle:Default:welcome.html.twig');
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
