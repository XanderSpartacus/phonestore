<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailController extends AbstractController
{
    #[Route('/send-mail', name: 'app_send_mail')]
    public function sendMail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('admin@phonstore.com') // expéditeur du mail
            ->to('client@phonestore.com') // destinataire du mail
            ->subject('Confirmation de votre commande !') // sujet du mail
            ->text('PhoneStore vous remercie pour votre commande !'); // contenu du mail

        $mailer->send($email);

        return new Response('Email envoyé !');
    }
}
