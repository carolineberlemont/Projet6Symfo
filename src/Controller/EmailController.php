<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\EmailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    /**
    * Permet de contacter l'admin
    * @Route("/contact_admin", name="contact_admin")
    *
    */
    public function contactAdmin(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){ 
                $message = (new \Swift_Message('Un message de NéSousX'))
                ->setFrom($contact->getEmail())
                ->setTo('nesousx.website@gmail.com')
                ->setBody($this->render('email/contact_admin.html.twig', [
                    'contact' => $contact
                ]),'text/html');
                $this->addFlash(
                    'success',
                    "Votre email a bien été envoyé. Je vous réponds au plus vite"
                );
                $mailer->send($message);
                return $this->render('home/about.html.twig');
            }
            elseif($form->isSubmitted()) { 
                $this->addFlash(
                    'success',
                    "Votre email n'a pas été envoyé. Merci de réessayer. En cas de problème récurrent, merci de contacter
                    l'administration directement à l'adresse : nesousx.website@gmail.com"
                );
            }
            return $this->render(
                'home/contact_admin.html.twig', 
                ['form'=>$form->createView()]
        );
    }

 
}
