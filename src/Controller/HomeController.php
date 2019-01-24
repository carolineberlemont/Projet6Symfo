<?php

namespace App\Controller;

use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller {
    

    /**
    * @Route("/about", name="about")
    */
    public function about(){
        return $this->render(
            'about.html.twig'
        );
    }

    /**
    * Permet de récupérer les trois dernières annonces de la bdd
    *
    * @Route("/", name="homepage")
    */
    public function home(AdRepository $repo)
    {
        $total = count($repo->findAll());
        $limit = 3;
        $offset = $total - $limit;
 
        $ads = $repo->findBy([], [], $limit, $offset);

        return $this->render('home.html.twig', [
            'ads' => $ads,
        ]);
    }

}

?>