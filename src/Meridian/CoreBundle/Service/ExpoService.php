<?php

namespace Meridian\CoreBundle\Service;

use Goutte\Client;
use Meridian\CoreBundle\Entity\Expo;

class ExpoService
{
    /**
     * @var
     */
    private $em;

    private  $start_url = 'http://www.muziejai.lt';

    /**
     * @param $entityManager
     */
    public function __construct( $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return array of all needed links from $url
     */
    private function getAllLinks()
    {
        $urls = [];
        $url = 'http://www.muziejai.lt/Aktualijos/naujos_parodos.asp';
        $client = new Client();
        $crawler = $client->request('GET', $url);
        foreach($crawler->filter('a') as $e) {
//            $urls[] = $e->textContent;
            if (strpos($e->textContent, 'Išsamiau') !== false)
            {
                $urls[] = str_replace('..','',$this->start_url . $e->getAttribute('href'));
            }
        }
        return $urls;
    }

    /**
     * @param $url from getAllLinks
     * @return array of data(name, address, time, city, url, picture)
     */
    private  function getExpoData($url)
    {
        $elements = [];
        $picture = '';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        foreach($crawler->filter('p') as $p) {
            $elements[] = $p;
        }

        foreach($crawler->filter('img') as $pic)
        {
            if (strpos($pic->getAttribute('src'), 'Upload') !== false)
            {
                $picture = $this->start_url . str_replace('..','', $pic->getAttribute('src'));
            }
        }
        $name = $elements[0]->textContent;
        $address = $elements[1]->textContent;
        $time = $elements[2]->textContent;
        $strArray = explode(',', $address);
        $city = end($strArray);
        return[$name, $address, $time, $url, trim($city), $picture];
    }

    /**
     * @return array. Main scraper, returns array of all data
     */
    private  function scraper()
    {
        $allData = [];
        $urls = $this->getAllLinks();
        foreach($urls as $link) {
            $allData[] = $this->getExpoData($link);
        }
        return $allData;
    }

    private function truncateTable()
    {
        $rep = $this->em->getConnection();
        $platform   = $rep->getDatabasePlatform();
        $rep->executeUpdate($platform->getTruncateTableSQL('Expo', true /* whether to cascade */));
    }

    public function updateData()
    {
        $allData = $this->scraper();
        $repository = $this->em->getRepository('MeridianCoreBundle:Expo');
        $oldRowCount = count($repository->findAll());
        $this->truncateTable();
        foreach($allData as $data)
        {
            $row = new Expo();
            $row->setName($data[0]);
            $row->setAddress($data[1]);
            $row->setTime($data[2]);
            $row->setLink($data[3]);
            $row->setCity($data[4]);
            $row->setPicture($data[5]);
            $this->em->persist($row);
        }
        $this->em->flush();
        return count($allData) - $oldRowCount;
    }
}