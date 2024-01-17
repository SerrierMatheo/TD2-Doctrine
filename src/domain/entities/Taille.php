<?php
namespace catadoct\catalog\domain\entities;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use catadoct\catalog\domain\repository\TailleRepository;


#[Entity(repositoryClass: TailleRepository::class)]
#[Table(name: "taille")]
class Taille
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue(strategy: "AUTO")]
    private int $id;
    #[Column(name: "libelle",
        type: Types::STRING)]
    private string $libelle;

    #[OneToMany(mappedBy: "taille", targetEntity: Tarif::class)]
    private Collection $tarif;

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \InvalidArgumentException("Property $name does not exist in " . static::class);
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new \InvalidArgumentException("Property $property does not exist in " . static::class);
        }
    }
}