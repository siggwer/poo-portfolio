<?php

/**
 * La configuration de PHP-DI pour les repositories
 */

use App\Repository\ObjectifRepositoryInterface;
use App\Repository\FormationRepositoryInterface;
use App\Repository\PdoObjectifRepository;
use App\Repository\PdoFormationRepository;

use function \DI\object as di_object;

return [
    ObjectifRepositoryInterface::class => di_object(PdoObjectifRepository::class),
    FormationRepositoryInterface::class => di_object(PdoFormationRepository::class)
];
