<?php
/**
 * Created by PhpStorm.
 * User: simas
 * Date: 16/11/14
 * Time: 19:17
 */

namespace Meridian\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProxyController extends Controller
{
    public function getScoresAction()
    {
        $user_id = $this->getUser();
        if ($user_id) {
            $dd = $this->getDoctrine()->getManager()->createQuery('SELECT p FROM MeridianUserBundle:User p ORDER BY p.scores ASC')->getResult();
            $user_position = array_search($user_id, $dd);
            $new = [$dd[$user_position-2],$dd[$user_position-1],$dd[$user_position], $dd[$user_position+1], $dd[$user_position+2] ];
        } else {
            $new = [];
        }

        return $this->render('MeridianCoreBundle:Proxy:scores.html.twig', ['scores' => $new]);
    }

    public function getProfilePicAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();
        return $this->render('MeridianCoreBundle:Proxy:profile_pic.html.twig', array('pic'=> $pic));
    }
}
