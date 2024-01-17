<?php

namespace catadoct\catalog\domain\repository;
use catadoct\catalog\domain\entities\Categorie;
use Doctrine\ORM\EntityRepository;

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