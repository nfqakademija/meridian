<?php

namespace Meridian\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MeridianCoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
