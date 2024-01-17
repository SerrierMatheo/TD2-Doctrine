<?php

namespace catadoct\catalog\domain\repository;
use catadoct\catalog\domain\entities\Taille;
use Doctrine\ORM\EntityRepository;

class TailleRepository extends EntityRepository
{
    public function findById(int $id): ?Taille
    {
        return $this->find($id);
    }

    public function findAllTailles(): array
    {
        return $this->findAll();
    }

    public function saveTaille(Taille $Taille): void
    {
        $this->_em->persist($Taille);
        $this->_em->flush();
    }

    public function updateTaille(Taille $Taille): void
    {
        $this->_em->flush();
    }

    public function deleteTaille(Taille $Taille): void
    {
        $this->_em->remove($Taille);
        $this->_em->flush();
    }
}