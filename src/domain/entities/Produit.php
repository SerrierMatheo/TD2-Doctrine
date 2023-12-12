<?php

namespace catadoct\catalog\domain\entities;

use catadoct\catalog\domain\repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: ProduitRepository::class)]
#[Table(name: "produit")]
class Produit
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    private int $id;
    #[Column(name: "numero",
        type: Types::INTEGER)]
    private string $numero;
    #[Column(name: "libelle",
        type: Types::STRING)]
    private string $libelle;
    #[Column(name: "description",
        type: Types::TEXT)]
    private string $description;
    #[Column(name: "image",
        type: Types::STRING)]
    private string $image;
    #[ManyToOne(targetEntity: Categorie::class)]
    #[JoinColumn(name: "categorie_id", referencedColumnName: "id")]
    private ?Categorie $categorie = null;

    #[OneToMany(mappedBy: "produit", targetEntity: Tarif::class)]
    private Collection $tarif;


    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property $name does not exist in " . static::class);
    }
}