<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller {
    /**
    * @Route("/", name="homepage")
    */
    public Function home(){
        return $this->render(
            'home.html.twig',
            [ 
                'title' => "Au revoir tout le monde",
                'age' => 12 
                ]
        );
    }

}

?>