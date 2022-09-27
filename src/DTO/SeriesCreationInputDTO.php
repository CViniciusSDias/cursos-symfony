<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SeriesCreationInputDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 5)]
        public string $seriesName = '',
        #[Assert\Positive]
        public int $seasonsQuantity = 0,
        #[Assert\Positive]
        public int $episodesPerSeason = 0,
        public ?string $coverImage = null,
    ) {
    }
}
