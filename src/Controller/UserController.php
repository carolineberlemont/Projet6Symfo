<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * Permet de voir le profil d'un utilisateur
     * @Route("/user/{slug}", name="user_show")
     * @IsGranted("ROLE_USER")
     */
    public function index(User $user)
    {
        return $this->render('user/index.html.twig', [
            'user'=> $user
        ]);
    }

        /**
    * Permet aux utilisateurs de se contacter entre eux
    * @Route("user/{slug}/contact", name="user_contact")
    * @IsGranted("ROLE_USER")
    */
    public function contact(Request $request, \Swift_Mailer $mailer, User $user)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){ 
                $message = (new \Swift_Message('Un message pour vous depuis le site NéSousX'))
                ->setFrom($contact->getEmail())
                ->setTo($user->getEmail())
                ->setBody($this->render('email/user_contact.html.twig', [
                    'contact' => $contact
                ]),'text/html');
                $this->addFlash(
                    'success',
                    "Votre email a bien été envoyé"
                );
                $mailer->send($message);
                // return $this->render('home/about.html.twig');
            }
            elseif($form->isSubmitted()) { 
                $this->addFlash(
                    'success',
                    "Votre email n'a pas été envoyé. Merci de réessayer. En cas de problème récurrent, merci de contacter
                    l'administration directement à l'adresse : nesousx.website@gmail.com"
                );
        }
        return $this->render(
            'user/user_contact.html.twig', 
            ['form'=>$form->createView(), 
            'user'=> $user]
        );
    }
}
