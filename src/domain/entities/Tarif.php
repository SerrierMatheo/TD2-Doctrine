<?php
namespace catadoct\catalog\domain\entities;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use catadoct\catalog\domain\repository\TarifRepository;

#[Entity(repositoryClass: TarifRepository::class)]
#[Table(name: "tarif")]
class Tarif
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    private int $id;
    #[Column(name: "libelle",
        type: Types::STRING)]
    private string $libelle;

    #[ManyToOne(targetEntity: Produit::class)]
    #[JoinColumn(name: "produit_id", referencedColumnName: "id")]
    private ?Produit $produit = null;
    #[ManyToOne(targetEntity: Taille::class)]
    #[JoinColumn(name: "taille_id", referencedColumnName: "id")]
    private ?Produit $taille = null;
    #[Column(name: "tarif",
        type: Types::INTEGER)]
    private string $tarif;

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property $name does not exist in " . static::class);
    }
}