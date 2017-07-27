<?php

namespace MedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MedBundle\Entity\Med;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MedBundle:Default:index.html.twig');
    }

public function registerAction()
    {
    	$m = " saisie votre donnés";
    	$request = $this->getRequest();
    	$em = $this->getDoctrine()->getManager();
    	if ($request->getMethod() == 'POST') {
    	$username = $request->request->get('username');
    	$email = $request->request->get('email');
    	$pass = $request->request->get('pass');
        $user= new Med();        
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $user->setSalt($salt);
    	$user->setUsername($username);
    	$user->setEmail($email);
		$user->setPassword(crypt($pass,$salt));
    	$em->persist($user);
    	$em->flush();

    	$m= "success";
        }
        return $this->render('default/registere.html.twig',array('m' => $m));
     }

}
