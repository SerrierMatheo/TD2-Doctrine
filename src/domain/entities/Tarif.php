<?php

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;


#[Entity]
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
    private ?Produit $produit_id = null;
    #[ManyToOne(targetEntity: Taille::class)]
    #[JoinColumn(name: "taille_id", referencedColumnName: "id")]
    private ?Produit $taille_id = null;
    #[Column(name: "tarif",
        type: Types::INTEGER)]
    private string $tarif;

}