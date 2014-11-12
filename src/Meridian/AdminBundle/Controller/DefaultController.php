<?php

namespace Meridian\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Meridian\CoreBundle\Entity\Game;
use Meridian\AdminBundle\Form\GameType;

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

    public function newgameAction()
    {
        $game = new Game();
        $form = $this->createForm(new GameType(), $game, array(
            'action'=>$this->generateUrl('admin_create_game'),
            'method' =>'POST'));
        $form->add('submit', 'submit', array('label' => 'Sukurti žaidimą'));
        return $this->render('MeridianAdminBundle:Default:new_game.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function createGameAction(Request $request)
    {
        $game = new Game();
        $form = $this->createForm(new GameType(), $game, array(
            'action' => $this->generateUrl('admin_create_game'),
            'method' => 'POST'));
        $form->add('submit', 'submit', array('label' => 'Sukurti žaidimą'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $this->get('session')->getFlashBag()->add('msg', 'Žaidimas buvo sukurtas');
            return $this->redirect($this->generateUrl('admin_show_game', array('id'=>$game->getId())));
        }
        $this->get('session')->getFlashBag()->add('msg', 'kažkas negerai');
        return $this->render('MeridianAdminBundle:Default:new_game.html.twig', array('form'=>$form->createView()));
    }

    public function showGameAction($id){
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('MeridianCoreBundle:Game')->find($id);

        return $this->render('MeridianAdminBundle:Default:show_game.html.twig', array(
            'game' => $game
        ));
    }

    public function showAllGamesAction() {
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('MeridianCoreBundle:Game')->findAll();
        return $this->render('MeridianAdminBundle:Default:all_games.html.twig', array('games' => $games));
    }

    public function editGameAction($id) {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('MeridianCoreBundle:Game')->find($id);
        $form = $this->createForm(new GameType(), $game, array(
            'action' => $this->generateUrl('admin_update_game', array('id'=>$game->getId())),
            'method' => 'PUT'));
        $form->add('submit', 'submit', array('label' => 'Redaguoti žaidimą'));
        return $this->render('MeridianAdminBundle:Default:edit_game.html.twig', array(
            'form'=>$form->createView()
        ));

    }

    public function updateGameAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('MeridianCoreBundle:Game')->find($id);
        $form = $this->createForm(new GameType(), $game, array(
            'action' => $this->generateUrl('admin_update_game', array('id' => $game->getId())),
            'method' => 'PUT'
        ));
        $form->add('submit', 'submit', array('label' => 'Patvirtinti'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('msg', 'Žaidimas buvo pakeistas');

            return $this->redirect($this->generateUrl('admin_show_game', array('id' => $id)));
        }
        return $this->render('MeridianAdminBundle:Default:edit_game.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteGameAction($id) {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('MeridianCoreBundle:Game')->find($id);
        $em->remove($game);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_show_all_games'));
    }
}
