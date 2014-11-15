<?php

namespace Meridian\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();

//        $userManager = $this->container->get('fos_user.user_manager');
//        $users = $userManager->findUsers();
//
//        foreach ($users)
//        exit;
//        $em =
//        $ens = $em->getRepository('AcmeBinBundle:Marks')
//            ->findBy(
//                array('type'=> 'C12'),
//                array('id' => 'ASC')
//            );

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
