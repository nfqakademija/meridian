<?php

namespace Meridian\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeridianUserBundle:Default:welcome.html.twig');
    }

    public function startAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user != 'anon.'){
            return $this->redirect($this->generateUrl("welcome_page"));
        }

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        // get the error if any
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            $error = $error->getMessage();
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            $session->save();
        }

        return $this->render('MeridianUserBundle:Default:start.html.twig', ['error' => $error]);
    }



    public function aboutAction()
    {
        return $this->render('MeridianUserBundle:Default:about.html.twig');
    }

}
