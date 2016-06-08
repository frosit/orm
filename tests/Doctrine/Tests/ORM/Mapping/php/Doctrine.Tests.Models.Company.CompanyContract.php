<?php

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping;

/* @var $metadata ClassMetadata */
$metadata->setInheritanceType(ClassMetadata::INHERITANCE_TYPE_JOINED);

$metadata->setPrimaryTable(['name' => 'company_contracts']);

$discrColumn = new Mapping\DiscriminatorColumnMetadata();

$discrColumn->setColumnName('discr');
$discrColumn->setType(Type::getType('string'));

$metadata->setDiscriminatorColumn($discrColumn);

$metadata->setDiscriminatorMap(array(
    "fix"       => "CompanyFixContract",
    "flexible"  => "CompanyFlexContract",
    "flexultra" => "CompanyFlexUltraContract"
));

$metadata->addProperty('id', Type::getType('string'), array(
    'id' => true,
));

$metadata->addProperty('completed', Type::getType('boolean'));

$metadata->addEntityListener(\Doctrine\ORM\Events::postPersist, 'CompanyContractListener', 'postPersistHandler');
$metadata->addEntityListener(\Doctrine\ORM\Events::prePersist, 'CompanyContractListener', 'prePersistHandler');

$metadata->addEntityListener(\Doctrine\ORM\Events::postUpdate, 'CompanyContractListener', 'postUpdateHandler');
$metadata->addEntityListener(\Doctrine\ORM\Events::preUpdate, 'CompanyContractListener', 'preUpdateHandler');

$metadata->addEntityListener(\Doctrine\ORM\Events::postRemove, 'CompanyContractListener', 'postRemoveHandler');
$metadata->addEntityListener(\Doctrine\ORM\Events::preRemove, 'CompanyContractListener', 'preRemoveHandler');

$metadata->addEntityListener(\Doctrine\ORM\Events::preFlush, 'CompanyContractListener', 'preFlushHandler');
$metadata->addEntityListener(\Doctrine\ORM\Events::postLoad, 'CompanyContractListener', 'postLoadHandler');