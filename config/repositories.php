<?php

/**
 * La configuration de PHP-DI pour les repositories
 */

use App\Repositories\CommentRepositoriesInterface;
use App\Repositories\PostRepositoriesInterface;
use App\Repositories\UserRepositoriesInterface;
use App\Repositories\PdoCommentRepository;
use App\Repositories\PdoPostRepository;
use App\Repositories\PdoUserRepository;

use function \DI\object as di_object;

return [
    PostRepositoriesInterface::class => di_object(PdoPostRepository::class),
    CommentRepositoriesInterface::class => di_object(PdoCommentRepository::class),
    UserRepositoriesInterface::class => di_object(PdoUserRepository::class)
];
