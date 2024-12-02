<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\SeriesWasCreated;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SleepNewSeriesHandler
{
    public function __invoke(SeriesWasCreated $message)
    {
        sleep(1);
    }
}
