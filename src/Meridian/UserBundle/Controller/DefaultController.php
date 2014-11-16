<?php

namespace Meridian\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();
        $dd = $this->getDoctrine()->getManager()->createQuery('SELECT p FROM MeridianUserBundle:User p ORDER BY p.scores ASC')->getResult();
        $user_position = array_search($user_id, $dd);
        $new = [$dd[$user_position-2],$dd[$user_position-1],$dd[$user_position], $dd[$user_position+1], $dd[$user_position+2] ];
        return $this->render('MeridianUserBundle:Default:welcome.html.twig', array('pic'=> $pic, 'scores' => $new));
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
