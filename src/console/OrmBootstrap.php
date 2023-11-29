<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

$entity_path = [__DIR__ . '/../domain/entities/'];
$isDevMode=true;
$dbParams = parse_ini_file(__DIR__ . '/../config/db.config.ini');
$config = ORMSetup::createAttributeMetadataConfiguration($entity_path, $isDevMode);
try {
    $connection = DriverManager::getConnection($dbParams, $config);
} catch (\Doctrine\DBAL\Exception $e) {
}
try {
    $entityManager = new EntityManager($connection, $config);
} catch (MissingMappingDriverImplementation $e) {
}

