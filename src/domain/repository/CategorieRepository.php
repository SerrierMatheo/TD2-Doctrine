<?php

namespace catadoct\catalog\domain\repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class CategorieRepository extends EntityRepository
{
    public function findById(int $id): ?Categorie
    {
        return $this->find($id);
    }

    public function findAllCategories(): array
    {
        return $this->findAll();
    }

    public function saveCategory(Categorie $categorie): void
    {
        $this->_em->persist($categorie);
        $this->_em->flush();
    }

    public function updateCategory(Categorie $categorie): void
    {
        $this->_em->flush();
    }

    public function deleteCategory(Categorie $categorie): void
    {
        $this->_em->remove($categorie);
        $this->_em->flush();
    }
}