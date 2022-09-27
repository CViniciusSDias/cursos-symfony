<?php

namespace App\Tests\Repository;

use App\DTO\SeriesCreationInputDTO;
use App\Repository\EpisodeRepository;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SeriesRepositoryTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $container = static::getContainer();
        $seriesRepository = $container->get(SeriesRepository::class);

        $seriesRepository->add(new SeriesCreationInputDTO(
            'Series test',
            2,
            5,
        ));

        $episodesRepository = $container->get(EpisodeRepository::class);
        $episodes = $episodesRepository->findAll();

        self::assertCount(10, $episodes);
    }
}
