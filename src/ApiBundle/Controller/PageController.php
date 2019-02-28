<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Api/Page/index.html.twig');
    }
    
    public function circularAction()
    {
        return $this->render('@Api/Page/circular.html.twig');
    }
}
