<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\SeriesWasCreated;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendNewSeriesEmailHandler
{
    public function __construct(
        private UserRepository $userRepository,
        private MailerInterface $mailer,
    ) {
    }

    public function __invoke(SeriesWasCreated $message)
    {
        $users = $this->userRepository->findAll();
        $usersEmails = array_map(fn (User $user) => $user->getEmail(), $users);
        $series = $message->series;

        $email = (new TemplatedEmail())
            ->from('sistema@example.com')
            ->to(...$usersEmails)
            ->subject('Nova série criada')
            ->text("Série {$series->getName()} foi criada criada")
            ->htmlTemplate('emails/series-created.html.twig')
            ->context(compact('series'));

        $this->mailer->send($email);
    }
}
