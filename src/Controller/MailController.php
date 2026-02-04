<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
            ->from('admin@phonestore.com') // expéditeur du mail
            ->to('client@phonestore.com') // destinataire du mail
            ->subject('Confirmation de votre commande !') // sujet du mail
            ->text('PhoneStore vous remercie pour votre commande !'); // contenu du mail

        $mailer->send($email);

        return new Response('Email envoyé !');
    }

    #[Route('/send-mail-html', name: 'app_send_mail_html')]
    public function sendMailHtml(MailerInterface $mailer): Response
    {
        $username = 'John Doe';

        $email = (new TemplatedEmail())
            ->from('admin@phonestore.com') // expéditeur du mail
            ->to('client@phonestore.com') // destinataire du mail
            ->subject('Confirmation de création de votre compte PhoneStore !') // sujet du mail
            ->htmlTemplate('email/new_mail.html.twig') // contenu du mail
            ->context([
                'username' => $username
            ]);

        $mailer->send($email);

        return new Response('Email HTML envoyé avec succès !');
    }

    #[Route('/send-order-confirmation', name: 'app_send_order_confirmation')]
    public function sendOrderConfirmation(MailerInterface $mailer): Response
    {
        $username = 'John Doe';

        $order = [
            'number' => 'CMD-2026-045',
            'date' => new \DateTimeImmutable(),
            'total' => 899.99,
            'items' => [
                ['name' => 'iPhone 15', 'quantity' => 1, 'price' => 799.99],
                ['name' => 'Coque silicone', 'quantity' => 1, 'price' => 100.00],
            ],
        ];

        $email = (new TemplatedEmail())
            ->from('commande@phonestore.com') // expéditeur du mail
            ->to('client@phonestore.com') // destinataire du mail
            ->subject('Confirmation de votre commande PhoneStore !') // sujet du mail
            ->htmlTemplate('email/order_confirmation.html.twig') // contenu du mail
            ->context([
                'username' => $username,
                'order' => $order,
            ]);

        $mailer->send($email);

        return new Response('Mail de confirmation de commande envoyé avec succès !');
    }
}
