<?php

namespace TestBundle\Controller;

use TestBundle\Entity\Insecte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Insecte controller.
 *
 * @Route("insecte")
 */
class InsecteController extends Controller
{
    /**
     * Lists all insecte entities.
     *
     * @Route("/{username}", name="insecte_index")
     * @Method("GET")
     */
    public function indexAction(Request $request,$username)
    {
        /*
        $em = $this->getDoctrine()->getManager();

        $usernamesession = $this->getUser()->getUsername();
        $insectes =$em->createQuery("SELECT c FROM TestBundle:Insecte c WHERE c.username != '$usernamesession' ")->getResult();

       return $this->render('insecte/index.html.twig', array(
          'insectes' => $insectes,
           ));
        */
        $em = $this->getDoctrine()->getManager();
       // $usernamesession=$request->query->get('username');

        $insectes =$em->createQuery("SELECT c FROM TestBundle:Insecte c WHERE c.username != '$username' ")->getArrayResult();

        $response = new Response();
        $response->setContent(json_encode(array('insectes' => $insectes)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    /**
     * Creates a new insecte entity.
     *
     * @Route("/new", name="insecte_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $insecte = new Insecte();
        $form = $this->createForm('TestBundle\Form\AmisType', $insecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insecte);
            $em->flush();

            return $this->redirectToRoute('insecte_show', array('id' => $insecte->getId()));
        }

        return $this->render('insecte/new.html.twig', array(
            'insecte' => $insecte,
            'form' => $form->createView(),
        ));
    }
    /**
     * add friend to insect
     *
     * @Route("/{id}/add", name="insecte_add")
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, Insecte $insecte)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$insecte->getInsectes()->contains($this->getUser())){
            $insecte->getInsectes()->add($this->getUser());
            $em->merge($insecte);
            $em->flush();
        }

        return $this->redirectToRoute("insecte_index");

    }
    /**
     * remove friend to insect
     *
     * @Route("/{id}/remove", name="insecte_del")
     * @Method({"GET", "POST"})
     */
    public function RemoveFriendAction(Request $request, Insecte $insecte)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        if($insecte->getInsectes()->contains($this->getUser())) {
            $insecte->getInsectes()->removeElement($this->getUser());
            $em->merge($insecte);
            $em->flush();
        }

        else if($user->getInsectes()->contains($insecte)){
            $user->getInsectes()->removeElement($insecte);
            $em->merge($user);
            $em->flush();

        }


       return $this->redirectToRoute("insecte_index");

    }
    /**
     * Finds and displays a insecte entity.
     *
     * @Route("/{id}", name="insecte_show")
     * @Method("GET")
     */
    public function showAction(Insecte $insecte)
    {
        $deleteForm = $this->createDeleteForm($insecte);


        return $this->render('insecte/show.html.twig', array(
            'insecte' => $insecte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing insecte entity.
     *
     * @Route("/{id}/edit", name="insecte_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Insecte $insecte)
    {
        $deleteForm = $this->createDeleteForm($insecte);
        $editForm = $this->createForm('TestBundle\Form\InsecteType', $insecte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('insecte_edit', array('id' => $insecte->getId()));
        }

        return $this->render('insecte/edit.html.twig', array(
            'insecte' => $insecte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a insecte entity.
     *
     * @Route("/{id}", name="insecte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Insecte $insecte)
    {
        $form = $this->createDeleteForm($insecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insecte);
            $em->flush();
        }

        return $this->redirectToRoute('insecte_index');
    }

    /**
     * Creates a form to delete a insecte entity.
     *
     * @param Insecte $insecte The insecte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Insecte $insecte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insecte_delete', array('id' => $insecte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
