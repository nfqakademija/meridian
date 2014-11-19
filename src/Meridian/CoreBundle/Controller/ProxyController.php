<?php


namespace Meridian\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProxyController extends Controller
{
    public function getScoresAction()
    {
        $new = [];
        $user_id = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $dd = $em->getRepository('MeridianUserBundle:User')->findBy(array('id' => $user_id));

        $user_score = $dd[0]->getScores();
        $lower = $em->getRepository('MeridianUserBundle:User')->createQueryBuilder('b')
            ->select('b')
            ->where('b.scores < :user_score')
            ->setParameter('user_score', $user_score)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();

        $bigger = $em->getRepository('MeridianUserBundle:User')->createQueryBuilder('b')
            ->select('b')
            ->where('b.scores > :user_score')
            ->setParameter('user_score', $user_score)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();

        $new = array_merge($lower, array($user_id), $bigger);
        return $this->render('MeridianCoreBundle:Proxy:scores.html.twig', ['scores' => $new]);
    }

    public function getProfilePicAction()
    {
        $user_id = $this->getUser();
        $pic = $user_id->getProfilePicturePath();
        return $this->render('MeridianCoreBundle:Proxy:profile_pic.html.twig', array('pic'=> $pic));
    }
}
