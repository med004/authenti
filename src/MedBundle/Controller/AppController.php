<?php

namespace MedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
     public function registerAction()
    {
        return $this->render('MedBundle:App:register.html.twig');
    }

}
