<?php

namespace Meridian\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Meridian\CoreBundle\Entity\Expo;
use Meridian\CoreBundle\Form\ExpoType;

/**
 * Expo controller.
 *
 */
class ExpoController extends Controller
{

    /**
     * Lists all Expo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MeridianCoreBundle:Expo')->findAll();

        return $this->render('MeridianCoreBundle:Expo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Expo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Expo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_expo_show', array('id' => $entity->getId())));
        }

        return $this->render('MeridianCoreBundle:Expo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Expo entity.
     *
     * @param Expo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Expo $entity)
    {
        $form = $this->createForm(new ExpoType(), $entity, array(
            'action' => $this->generateUrl('admin_expo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Expo entity.
     *
     */
    public function newAction()
    {
        $entity = new Expo();
        $form   = $this->createCreateForm($entity);

        return $this->render('MeridianCoreBundle:Expo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Expo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MeridianCoreBundle:Expo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MeridianCoreBundle:Expo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Expo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MeridianCoreBundle:Expo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MeridianCoreBundle:Expo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Expo entity.
    *
    * @param Expo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Expo $entity)
    {
        $form = $this->createForm(new ExpoType(), $entity, array(
            'action' => $this->generateUrl('admin_expo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Expo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MeridianCoreBundle:Expo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Expo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_expo_edit', array('id' => $id)));
        }

        return $this->render('MeridianCoreBundle:Expo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Expo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MeridianCoreBundle:Expo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Expo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_expo'));
    }

    /**
     * Creates a form to delete a Expo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_expo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function expoAction(Request $request)
    {
        $expo = $this->getDoctrine()->getRepository('MeridianCoreBundle:Expo');
        $allExpo = $expo->findAll();

        $cities = $expo->createQueryBuilder('cc')
                ->select('cc.city')
                ->distinct()
                ->getQuery();

        $uniqCities = $cities->getResult();
//        var_dump($uniqCities);
//        exit;

//        $form = $this->createFormBuilder()
//            ->add('Miestas', 'choice', array(
//                'choices' => $uniqCities,
//                'expanded' => true
//            ))
//            ->getForm();

        return $this->render('MeridianCoreBundle:Default:expo.html.twig', array('expos' => $allExpo, 'cities'=>$uniqCities));
    }
}
