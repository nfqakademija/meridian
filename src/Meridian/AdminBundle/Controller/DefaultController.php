<?php

namespace Meridian\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MeridianAdminBundle:Default:index.html.twig', array('name' => $name));
    }

    public function adminAction()
    {
        return $this->render('MeridianAdminBundle:Default:admin_home.html.twig');
    }
}
