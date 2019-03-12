<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\SearchType;
use App\Form\AnnonceType;
use App\Form\ContactType;
use App\Service\EmailService;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
// require_once '/path/to/vendor/autoload.php';


class HomeController extends Controller {    

    /**
    *
    * @Route("/", name="before")
    */
    public function before()
    {
        return $this->render('home/before.html.twig');
    }

    /**
    * Permet de récupérer les trois dernières annonces de la bdd
    *
    * @Route("/home", name="homepage")
    */
    public function home(AdRepository $repo)
    {
        $total = count($repo->findAll());
        $limit = 3;
        $offset = $total - $limit;
 
        $ads = $repo->findBy([], [], $limit, $offset);

        return $this->render('home/home.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
    * @Route("/about", name="about")
    */
    public function about(){
        return $this->render(
            'home/about.html.twig'
        );
    }

    /**
    * @Route("/ml", name="mentions_legales")
    */
    public function ml(){
        return $this->render(
            'home/ml.html.twig'
        );
    }
}

?>