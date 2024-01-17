<?php

namespace catadoct\catalog\domain\repository;

use catadoct\catalog\domain\entities\Tarif;
use Doctrine\ORM\EntityRepository;

class TarifRepository extends EntityRepository
{
    public function findById(int $id): ?Tarif
    {
        return $this->find($id);
    }

    public function findAllTarifs(): array
    {
        return $this->findAll();
    }

    public function saveTarif(Tarif $Tarif): void
    {
        $this->_em->persist($Tarif);
        $this->_em->flush();
    }

    public function updateTarif(Tarif $Tarif): void
    {
        $this->_em->flush();
    }

    public function deleteTarif(Tarif $Tarif): void
    {
        $this->_em->remove($Tarif);
        $this->_em->flush();
    }
}