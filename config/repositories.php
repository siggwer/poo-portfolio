<?php

/**
 * La configuration de PHP-DI pour les repositories
 */

use App\Repository\ObjectifRepositoryInterface;
use App\Repository\FormationRepositoryInterface;
use App\Repository\CommentRepositoriesInterface;
use App\Repository\PostRepositoriesInterface;
use App\Repository\UserRepositoriesInterface;
use App\Repository\PdoObjectifRepository;
use App\Repository\PdoFormationRepository;
use App\Repository\PdoCommentRepository;
use App\Repository\PdoPostRepository;
use App\Repository\PdoUserRepository;

use function \DI\object as di_object;

return [
    ObjectifRepositoryInterface::class => di_object(PdoObjectifRepository::class),
    FormationRepositoryInterface::class => di_object(PdoFormationRepository::class),
    PostRepositoriesInterface::class => di_object(PdoPostRepository::class),
    CommentRepositoriesInterface::class => di_object(PdoCommentRepository::class),
    UserRepositoriesInterface::class => di_object(PdoUserRepository::class)
];
