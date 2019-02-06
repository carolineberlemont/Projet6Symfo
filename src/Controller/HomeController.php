<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\SearchType;
use App\Form\AnnonceType;
use App\Form\ContactType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
require_once '/path/to/vendor/autoload.php';


class HomeController extends Controller {    

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
    * @Route("/contact", name="contact")
    * @return Response
    */
    public function contact(Request $request) {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // //ici, il faut m'envoyer l'email
            // $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
            // ->setUsername('berlemont2000') ??
            // ->setPassword('ross209way306') ??
            // ;
            // // Create the Mailer using your created Transport
            // $mailer = new Swift_Mailer($transport);
            // // Create a message
            // $message = (new Swift_Message)
            // ->setFrom(['name' => $contact->getName()]) ??
            // ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
            // ->setBody('message' => $contact->getMessage()) ??            // ;
            // // Send the message
            // $result = $mailer->send($message);

            $this->addFlash(
                'success',
                "Votre email a bien été envoyé. Je vous réponds dans les meilleurs délais"
            );
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            'home/contact.html.twig', 
            ['form'=>$form->createView()]
        );
    }



}

?>