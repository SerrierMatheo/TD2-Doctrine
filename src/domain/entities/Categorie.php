<?php
namespace catadoct\catalog\domain\entities;

use catadoct\catalog\domain\repository\CategorieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\Collection;

#[Entity(repositoryClass: CategorieRepository::class)]
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
    #[OneToMany(mappedBy: "categorie", targetEntity: Produit::class)]
    private Collection $produits;

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property $name does not exist in " . static::class);
    }
}