<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$entityManager = require_once __DIR__ . '/OrmBootstrap.php';

$produit = $entityManager->getRepository(Produit::class)->find(4);

print $produit->id . "\n";
print $produit->numero . "\n";
