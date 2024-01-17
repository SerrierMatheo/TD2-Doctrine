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

$categorieDuProduit = $produit->categorie;
$libelleCategorie = $categorieDuProduit->libelle;

print "Catégorie du Produit : $libelleCategorie\n";

//-------------------------------------------------------------

$categorieRepository = $entityManager->getRepository(Categorie::class);

$categorie = $categorieRepository->find(5);

print "catégorie 5 : " . $categorie->libelle . PHP_EOL;

// Créez un nouveau produit
$nouveauProduit = new Produit();
$nouveauProduit->numero = 11;
$nouveauProduit->libelle = 'Quatre fromages';
$nouveauProduit->description = 'Tomate, mozzarella, chèvre, comté, cheddar, basilic';
$nouveauProduit->image = 'chemin/vers/image.jpg';

$nouveauProduit->categorie = $categorie;

$entityManager->persist($nouveauProduit);
$entityManager->flush();

print "Nouveau produit créé et enregistré avec succès.\n";

$produits = $categorie->produits;

// Parcourez la collection de produits et faites quelque chose avec chaque produit
foreach ($produits as $produit) {
    // Accédez aux propriétés du produit
    $nomProduit = $produit->libelle; // Assurez-vous d'ajuster la propriété selon votre entité Produit

    // Faites quelque chose avec les données du produit
    print "Libelle : $nomProduit\n";
}

$nouveauProduit->libelle = '6 fromages';

$entityManager->remove($nouveauProduit);
$entityManager->flush();