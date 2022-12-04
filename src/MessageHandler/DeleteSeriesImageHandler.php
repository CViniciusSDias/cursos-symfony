<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\SeriesWasDeleted;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class DeleteSeriesImageHandler
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private Filesystem $filesystem
    ) {
    }

    public function __invoke(SeriesWasDeleted $message)
    {
        $coverImagePath = $message->series->getCoverImagePath();
        $this->filesystem->remove(
            $this->parameterBag->get('cover_image_directory') . DIRECTORY_SEPARATOR . $coverImagePath
        );
    }
}
