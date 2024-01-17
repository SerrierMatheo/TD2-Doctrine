<?php

namespace catadoct\catalog\domain\Repository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

class ProduitRepository extends EntityRepository
{
    public function getProduitsByCat(string $keyword): Collection
    {
        return $this->matching(Criteria::create()
            ->where(Criteria::expr()->contains('categorie', $keyword))
            ->orderBy(['numero' => 'ASC'])
        );
    }

    public function getProduitsByDesc(string $keyword): Collection
    {
        return $this->matching(Criteria::create()
            ->where(Criteria::expr()->contains('description', $keyword))
            ->orderBy(['numero' => 'ASC'])
        );
    }
    public function getProduitsByDescAndCat(string $keyword, int $cat): Collection{
        return $this->matching(Criteria::create()
            ->where(Criteria::expr()->contains('description', $keyword))
            ->andWhere(Criteria::expr()->eq('categorie', $cat))
            ->orderBy(['numero' => 'ASC'])
        );
    }
    public function getProduitsAndTarifByCat(string $cat) : array {
        $cat = CategorieRepository::class->find(5);
        $dql = "SELECT p, t FROM domain\\entities\Produit p
        JOIN p.categorie WITH  p.categorie = :cat
        JOIN p.tarif t 
        ORDER BY p.numero ASC";
        $query= $this->getEntityManager()->createQuery($dql);
        $query->setParameter('cat', $cat);
        return $query->getResult();
    }
    public function getProduitByDescOrLib(string $keyword): Collection{
        $dql = "SELECT p FROM domain\\entities\Produit p
        WHERE p.libelle like :keyword
        ORWHERE p.description like :keyword";
        $query= $this->getEntityManager()->createQuery($dql);
        $query->setParameter('keyword', $keyword);
        return $query->getResult();
    }

    public function getProduitByTarif(float $tarifId): Collection{
        $dql = "SELECT p, t FROM domain\\entities\Produit p
        JOIN p.tarif t WHERE t.tarif <= :tarif
        ORDER BY p.numero ASC";
        $query= $this->getEntityManager()->createQuery($dql);
        $query->setParameter('tarif', $tarifId);
        return $query->getResult();
    }

    public function getProduitsByNumAndSize(int $tailleId, int $cat): Collection{
        $dql = "SELECT p FROM domain\\entities\Produit p
        JOIN p.taille t WHERE t.id = :taille
        AND p.categorie = :cat
        ORDER BY p.numero ASC";
        $query= $this->getEntityManager()->createQuery($dql);
        $query->setParameter('taille', $tailleId);
        $query->setParameter('cat', $cat);
        return $query->getResult();

    }
}