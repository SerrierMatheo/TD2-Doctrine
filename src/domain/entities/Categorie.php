<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\Collection;

#[Entity]
#[Table(name: "categorie")]
class Categorie {
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    private int $id;
    #[Column(name: "libelle",
        type: Types::STRING,
        length: 100)]
    private string $libelle;
    #[OneToMany(targetEntity: Produit::class, mappedBy: "categorie")]
    private Collection $categorie;
}