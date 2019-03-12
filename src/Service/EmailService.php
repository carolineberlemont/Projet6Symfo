<?php

namespace App\Service;

use Twig\Environment;
use App\Entity\Contact;

class EmailService {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct (\Swift_Mailer $mailer, Environment $renderer){
        $this->mailer = $mailer;
        $this->renderer = $renderer;

    }

    public function sendemail (Contact $contact)
    {
        $message = (new \Swift_Message('Un message pour vous depuis le site NéSousX'))
        ->setFrom($contact->getEmail())
        ->setTo('nesousx.website@gmail.com')
        ->setBody($this->renderer->render('email/contact.html.twig', [
                'contact' => $contact
            ]),'text/html');
        
        $this->mailer->send($message);
    }
}
      