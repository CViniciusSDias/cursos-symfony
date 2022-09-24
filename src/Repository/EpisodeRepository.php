<?php

namespace App\Repository;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Episode>
 *
 * @method Episode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Episode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Episode[]    findAll()
 * @method Episode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Episode::class);
    }

    /**
     * @param int $episodesPerSeason
     * @param Season[] $seasons
     * @return void
     * @throws \Doctrine\DBAL\Exception
     */
    public function addEpisodesPerSeason(int $episodesPerSeason, array $seasons): void
    {
        $params = array_fill(0, $episodesPerSeason, '(?, ?)');
        $connection = $this->getEntityManager()->getConnection();
        $sql = 'INSERT INTO episode (season_id, number) VALUES ' . implode(', ', $params);
        $stm = $connection->prepare($sql);

        foreach ($seasons as $season) {
            for ($i = 0; $i < $episodesPerSeason; $i++) {
                $stm->bindValue($i * 2 + 1, $season->getId(), \PDO::PARAM_INT);
                $stm->bindValue($i * 2 + 2, $i + 1, \PDO::PARAM_INT);
            }
            $stm->executeQuery();
        }
    }
}
