<?php

namespace TestAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
* Renders the "new" form
*
* @Route("/asdf/", name="demo_new")
* @Method("GET")
*/
    public function newAction(\Symfony\Component\HttpFoundation\Request $request)
{
    $entity = new Demo();
    $form = $this->createCreateForm($entity);
 
    return $this->render('AcmeDemoBundle:Demo:new.html.twig',
                    array(
                'entity' => $entity,
                'form' => $form->createView()
                    )
    );
}

/**
* Creates a new Demo entity.
*
* @Route("/demo/", name="demo_create")
* @Method("POST")
*
*/
public function createAction(\Symfony\Component\HttpFoundation\Request $request)
{
    //This is optional. Do not do this check if you want to call the same action using a regular request.
    if (!$request->isXmlHttpRequest()) {
        return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
    }
 
    $entity = new Demo();
    $form = $this->createCreateForm($entity);
    $form->handleRequest($request);
 
    if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
 
        return new JsonResponse(array('message' => 'Success!'), 200);
    }
 
    $response = new JsonResponse(
            array(
        'message' => 'Error',
        'form' => $this->renderView('AcmeDemoBundle:Demo:form.html.twig',
                array(
            'entity' => $entity,
            'form' => $form->createView(),
        ))), 400);
 
    return $response;
}
/**
* Creates a form to create a Demo entity.
*
* @param Demo $entity The entity
*
* @return SymfonyComponentFormForm The form
*/
private function createCreateForm(Demo $entity)
{
    $form = $this->createForm(new DemoType(), $entity,
            array(
        'action' => $this->generateUrl('demo_create'),
        'method' => 'POST',
    ));
 
    return $form;
}
    
    
    
    
    
    /**
     * @Route("/cos/")
     * @Template()
     */
    public function indexAction(\Symfony\Component\HttpFoundation\Request $request, $name)
    {
        $hw = new \TestAppBundle\Przyklad\HelloWorld();
        $form = $this->createForm(new \TestAppBundle\Form\ObrazkiType());
        $form->handleRequest($request);
        
        if($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($form->getData());
            $this->getDoctrine()->getManager()->flush();
        }
        
          
        return array( 'xform' => $form->createView(), 'hw'=> $hw->sayHello()); 
    }
    /**
     * @Route("/jkl/" , name="ome")
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
