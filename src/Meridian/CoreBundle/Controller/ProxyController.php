<?php


namespace Meridian\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProxyController extends Controller
{
    public function getScoresAction()
    {
        $scoreService = $this->get('meridian_core.scores');
        $scores = $scoreService->getScoresData();
        return $this->render('MeridianCoreBundle:Proxy:scores.html.twig', array('scores' => $scores));
    }

    public function getProfilePicAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();
        return $this->render('MeridianCoreBundle:Proxy:profile_pic.html.twig', array('pic'=> $pic));
    }
}
