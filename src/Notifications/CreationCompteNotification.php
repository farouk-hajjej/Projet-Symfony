<?php

namespace App\Notifications;
//on importe les classes nécesssaires a l'envoie de mail et Twig
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreationCompteNotification{
    /**
     * Propriété contenant le module d'envoi de mails
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * Propriété contenant l'environnement Twig
     * @var Environment
     */
    private $renderer;
    public function __construct(\Swift_Mailer $mailer,Environment $renderer)
    {
        $this->mailer=$mailer;
        $this->renderer=$renderer;
    }

    /**
     * Methode de notification(envoi de mail)
     * @return void
     */
    public function notify()
    {
     //on construit le mail
        $message =(new Swift_Message('Nouvelle Inscription '))
            //Expéditeur
        ->setFrom('hajje.farouk6@gmail.com')
            //Destinataire
        ->setTo('farouk.hajjej@esprit.tn')
            //corps du message
            ->setBody(
               $this->renderer->render(
                  'emails/ajout_compte_notification.html.twig'
               ),
                'text/html'
            );
        //on envoie le mail
        $this->mailer->send($message);
    }


}
