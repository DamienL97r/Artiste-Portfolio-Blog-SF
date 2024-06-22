<?php

namespace App\Services;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

readonly class MailerService
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendMail(
        string $sender,
        string $recipient,
        string $subject,
        string $htmlTemplate,
        array $context
    ): void {
        $email = (new TemplatedEmail())
                ->from($sender)
                ->to($recipient)
                ->subject($subject)
                ->htmlTemplate($htmlTemplate)
                ->context($context);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
}
