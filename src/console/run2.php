<?php

use catadoct\catalog\domain\entities\Categorie;
use catadoct\catalog\domain\entities\Produit;

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = require_once __DIR__ . '/OrmBootstrap.php';

$produitRepository = $entityManager->getRepository(Produit::class);

$numeroRecherche = 4;
$produit = $produitRepository->findOneBy(['numero' => $numeroRecherche]);

if ($produit !== null) {
    echo "Numéro du produit : " . $produit->numero . "\n";
    echo "Libellé du produit : " . $produit->libelle . "\n";
    echo "Description du produit : " . $produit->description . "\n";
    echo "Image du produit : " . $produit->image . "\n";
} else {
    echo "Produit non trouvé.\n";
}

echo "-------------------------\n";

$numeroRecherche = 5;
$libelleRecherche = 'Pepperoni';

$produit = $produitRepository->findOneBy([
    'numero' => $numeroRecherche,
    'libelle' => $libelleRecherche
]);

if ($produit !== null) {
    echo "Numéro du produit : " . $produit->numero . "\n";
    echo "Libellé du produit : " . $produit->libelle . "\n";
    echo "Description du produit : " . $produit->description . "\n";
    echo "Image du produit : " . $produit->image . "\n";
} else {
    echo "Produit non trouvé.\n";
}

echo "-------------------------\n";

$categorieRepository = $entityManager->getRepository(Categorie::class);

$libelleCategorieRecherche = 'Boissons';
$categorieBoissons = $categorieRepository->findOneBy(['libelle' => $libelleCategorieRecherche]);

if ($categorieBoissons !== null) {
    echo "Libellé de la catégorie : " . $categorieBoissons->libelle . "\n";

    $produitsBoissons = $categorieBoissons->produits;

    foreach ($produitsBoissons as $produit) {
        echo "Numéro du produit : " . $produit->numero . "\n";
        echo "Libellé du produit : " . $produit->libelle . "\n";
        echo "Description du produit : " . $produit->description . "\n";
        echo "Image du produit : " . $produit->image . "\n";
        echo "------------\n";
    }
} else {
    echo "Catégorie 'Boissons' non trouvée.\n";
}

echo "-------------------------\n";

echo "Produits contenant de la mozzarella\n";

$descriptionContient = 'mozzarella';
$produitsMozzarella = $produitRepository->createQueryBuilder('p')
    ->where('p.description LIKE :description')
    ->setParameter('description', '%' . $descriptionContient . '%')
    ->getQuery()
    ->getResult();

if (!empty($produitsMozzarella)) {
    foreach ($produitsMozzarella as $produit) {
        echo "Numéro du produit : " . $produit->numero . "\n";
        echo "Libellé du produit : " . $produit->libelle . "\n";
        echo "Description du produit : " . $produit->description . "\n";
        echo "Image du produit : " . $produit->image . "\n";
        echo "-----------\n";
    }
} else {
    echo "Aucun produit contenant 'mozzarella' dans la description n'a été trouvé.\n";
}

echo "-------------------------\n";
echo "Produits contenant du jambon et appartenant à la catégorie 5\n";

$categorie5 = $categorieRepository->find(5);

// Vérifiez si la catégorie existe
if ($categorie5 !== null) {
    // Recherchez les produits de la catégorie 5 contenant 'jambon' dans la description
    $descriptionContient = 'jambon';
    $produitsJambon = $produitRepository->createQueryBuilder('p')
        ->where('p.categorie = :categorie')
        ->andWhere('p.description LIKE :description')
        ->setParameter('categorie', $categorie5)
        ->setParameter('description', '%' . $descriptionContient . '%')
        ->getQuery()
        ->getResult();

    // Vérifiez si des produits ont été trouvés
    if (!empty($produitsJambon)) {
        // Parcourez les produits trouvés et affichez leurs détails
        foreach ($produitsJambon as $produit) {
            echo "Numéro du produit : " . $produit->numero . "\n";
            echo "Libellé du produit : " . $produit->libelle . "\n";
            echo "Description du produit : " . $produit->description . "\n";
            echo "Image du produit : " . $produit->image . "\n";
            echo "-------------------------\n";
        }
    } else {
        // Aucun produit trouvé dans la catégorie 5 contenant 'jambon' dans la description
        echo "Aucun produit dans la catégorie 5 contenant 'jambon' dans la description n'a été trouvé.\n";
    }
} else {
    // La catégorie 5 n'a pas été trouvée
    echo "Catégorie 5 non trouvée.\n";
}