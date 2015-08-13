<?php

namespace TestAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TestAppBundle\Entity\User;
/**
 * @Route("/default")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/cos/{name}")
     * @Template()
     */
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request, $name)
    {
        
        $form = $this->createForm(new \TestAppBundle\Form\ObrazkiType());
        $form->handleRequest($request);
        
        if($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($form->getData());
            $this->getDoctrine()->getManager()->flush();
        }
        
          
        return array( 'xform' => $form->createView()); 
    }
    /**
     * @Route("/" , name="ome")
     * Template("AppBundle:AAAAA:index.html.twig")
     * @Template()
     */
    public function index2Action()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $productRepository = $entityManager->getRepository('User');
        $products = $productRepository->findAll();
        $tab=array();
        foreach ($products as $product) {
            $id=$product->getId();
            $tab[$id]=$product->getLogin();
            }
        return  $this->render('TestAppBundle:Default:index.html.twig',array(
           'login'=>$tab[1]
        ));
    }
    
    
    /**
     * @Route("/show" , name="ome1")
     */
    public function displayAction() {
        
        $items = $this->getDoctrine()->getRepository('TestAppBundle:User')->findAll();
        
        
        return $this->render('TestAppBundle:Default:display.html.twig', array(
               'items' => $items  
        ));
        
    }
    
    
    
}
