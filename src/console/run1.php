<?php

use catadoct\catalog\domain\entities\Categorie;
use catadoct\catalog\domain\entities\Produit;

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = require_once __DIR__ . '/OrmBootstrap.php';

$produitRepository = $entityManager->getRepository(Produit::class);

$produit = $produitRepository->find(4);

print $produit->numero . "\n";
print $produit->libelle . "\n";
print $produit->description . "\n";
print $produit->image . "\n";

$categorieRepository = $entityManager->getRepository(Categorie::class);

$categorie = $categorieRepository->find(5);

print $categorie->libelle . "\n";