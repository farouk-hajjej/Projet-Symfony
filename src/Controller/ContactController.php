<?php

namespace App\Controller;

use App\Form\ContactType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request, \Swift_Mailer $mailer): Response
    {
        $form=$this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact=$form->getData();
            //ici nous enverons le mail
            $message = (new \Swift_Message('Nouveau Contact'))
               //on attribue l'expéditeur :la persoone qui remplie la formulaire
            ->setFrom($contact['email'])
            //on attribue le distinataire
            ->setTo('farouk.hajjej@esprit.tn')
                //on créé le message avec la vue Twig
            ->setBody(
                $this->renderView(
                    'emails/contact.html.twig',compact('contact')
                ),
                    'text/html'
                )
                ;
            //on envoie le message
            $mailer->send($message);
            $this->addFlash('message','Le message a bien été envoyer');
            return $this->redirect('frontstade');
        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()

        ]);
    }
}
