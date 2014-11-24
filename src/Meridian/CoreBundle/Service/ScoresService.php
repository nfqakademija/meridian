<?php

namespace Meridian\CoreBundle\Service;

use Doctrine\ORM\EntityManager;


class ScoresService
{
    /**
     * @var
     */
    private $em;
    private $container;

    /**
     * @param $entityManager
     * @param $container
     */
    public function __construct( $entityManager, $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getScoresData()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $userScore = $user->getScores();
        $lower = $this->em->getRepository('MeridianUserBundle:User')->createQueryBuilder('b')
            ->select('b')
            ->where('b.scores < :user_score')
            ->setParameter('user_score', $userScore)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();

        $bigger = $this->em->getRepository('MeridianUserBundle:User')->createQueryBuilder('b')
            ->select('b')
            ->where('b.scores > :user_score')
            ->setParameter('user_score', $userScore)
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
        $scores = array_merge($lower, [$user], $bigger);
        return $scores;
    }
}