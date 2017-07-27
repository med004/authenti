<?php

namespace MedBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;
use MedBundle\Entity\Med;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\EventListener\JWTCreatedlistener;

 Class ApiController extends Controller {

 	public function getAction() {

 		$em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('MedBundle:Med')->findAll();
        //$viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
        //$view = View::create($test);
        //$view->setFormat('json');

        // Gestion de la réponse
        //return $viewHandler->handle($view);
        return array('test'=>$test);

 	}


 	public function loginAction() {

 		$em = $this->getDoctrine()->getManager();
 		$request = $this->getRequest();
 		$test = null; $token = null; $res = 'null';
 		if ($request->getMethod() == 'POST') {
	 		$username = $request->request->get('username');
	    	$password = $request->request->get('password');

	     $test = $em->getRepository('MedBundle:Med')->findOneBy(array('username' => $username));

	        if (!($test)) { $res = "error"; } else{ 
	        	$salt= $test->getSalt();
	        	$pass = crypt($password,$salt);
	        	if ( $pass !== $test->getPassword() ) { $res='error password'; } else {
	        	$res='success';   
	       
	        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($test);
	        
	        $test->setToken($token);
	       	$em->persist($test);
	    	$em->flush();

	     } } 
	     //return new Response($res);
	     $test = [];
	     $test['token'] = $token;
	     $test['res'] = $res;
	     return new JsonResponse($test);
 }	  
	 		
	 		return $this->render('default/login.html.twig',array('test' => json_encode($test), 'token' => $token,'res' => json_encode($res)));

 	}



 	public function logoutAction() {


 		
 	}

 }