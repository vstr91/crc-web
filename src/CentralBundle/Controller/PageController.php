<?php

namespace CentralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Central/Page/index.html.twig');
    }
    
    public function homeAction()
    {
        return $this->render('@Central/Page/home.html.twig');
    }
    
}
