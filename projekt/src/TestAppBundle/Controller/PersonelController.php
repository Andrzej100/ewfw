<?php

namespace TestAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TestAppBundle\Entity\Personel;
use TestAppBundle\Form\PersonelType;
use TestAppBundle\Form\Obrazki;
use TestAppBundle\Form\ObrazkiType;

/**
 * Personel controller.
 *
 * @Route("/personel")
 */
class PersonelController extends Controller
{

    /**
     * Lists all Personel entities.
     *
     * @Route("/", name="personel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TestAppBundle:Personel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Personel entity.
     *
     * @Route("/", name="personel_create")
     * @Method("POST")
     * @Template("TestAppBundle:Personel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Obrazki();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $ufile = $request->get('obrazek');
            
           
            file_put_contents('/web/'.$ufile['name'], $ufile['data']);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Personel entity.
     *
     * @param Personel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Obrazki $entity)
    {
        $form = $this->createForm(new ObrazkiType(), $entity, array(
            'action' => $this->generateUrl('personel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Personel entity.
     *
     * @Route("/new", name="personel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Obrazki();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Personel entity.
     *
     * @Route("/{id}", name="personel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestAppBundle: obrazki')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Personel entity.
     *
     * @Route("/{id}/edit", name="personel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestAppBundle: Obrazki')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personel entity.');
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
    * Creates a form to edit a Personel entity.
    *
    * @param Personel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Personel $entity)
    {
        $form = $this->createForm(new ObrazkiType(), $entity, array(
            'action' => $this->generateUrl('personel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Personel entity.
     *
     * @Route("/{id}", name="personel_update")
     * @Method("PUT")
     * @Template("TestAppBundle:Personel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestAppBundle:Obrazki')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('personel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Personel entity.
     *
     * @Route("/{id}", name="personel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TestAppBundle: Obrazki')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personel'));
    }

    /**
     * Creates a form to delete a Personel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
