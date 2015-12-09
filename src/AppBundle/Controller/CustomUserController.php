<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\CustomUser;
use AppBundle\Form\Type\CustomUserType;

/**
 * CustomUser controller.
 *
 * @Route("/cms/user")
 */
class CustomUserController extends Controller
{

    /**
     * Lists all CustomUser entities.
     *
     * @Route("/", name="cms_user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CustomUser')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CustomUser entity.
     *
     * @Route("/", name="cms_user_create")
     * @Method("POST")
     * @Template("AppBundle:CustomUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CustomUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cms_user_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CustomUser entity.
     *
     * @param CustomUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CustomUser $entity)
    {
        $form = $this->createForm(new CustomUserType(), $entity, array(
            'action' => $this->generateUrl('cms_user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CustomUser entity.
     *
     * @Route("/new", name="cms_user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CustomUser();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CustomUser entity.
     *
     * @Route("/{id}", name="cms_user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CustomUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CustomUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CustomUser entity.
     *
     * @Route("/{id}/edit", name="cms_user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CustomUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CustomUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a CustomUser entity.
    *
    * @param CustomUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CustomUser $entity)
    {
        $form = $this->createForm(new CustomUserType(), $entity, array(
            'action' => $this->generateUrl('cms_user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CustomUser entity.
     *
     * @Route("/{id}", name="cms_user_update")
     * @Method("PUT")
     * @Template("AppBundle:CustomUser:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CustomUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CustomUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cms_user_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CustomUser entity.
     *
     * @Route("/{id}", name="cms_user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CustomUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CustomUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cms_user'));
    }

    /**
     * Creates a form to delete a CustomUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
