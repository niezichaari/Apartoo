<?php

namespace TestBundle\Controller\API;

use TestBundle\Entity\Insecte;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Api controller.
 *
 * @Route("insecte")
 */
class ApiController extends Controller
{
    /**
     * Lists all insecte entities.
     *
     * @Route("/", name="insecte_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usernamesession = $this->getUser()->getUsername();
        $insectes =$em->createQuery("SELECT c FROM TestBundle:Insecte c WHERE c.username != '$usernamesession' ")->getArrayResult();

        $response = new Response();
        $response->setContent(json_encode(array('insectes' => $insectes)));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
