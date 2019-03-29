<?php

namespace App\Service;

use App\Repository\ObjectifRepositoryInterface;

//use Framework\Database\StatementInterface;

class ObjectifService
{
    /**
     * @var
     */
    private $objectifRepository;

    /**
     * ObjectifService constructor.
     *
     * @param ObjectifRepositoryInterface $objectifRepository
     */
    public function __construct(ObjectifRepositoryInterface $objectifRepository)
    {
        $this->objectifRepository = $objectifRepository;
    }

    /**
     * @return array
     */
    public function allObjectif(): array
    {
        $objectif = $this->objectifRepository->allObjectifs();
        return $objectif;
    }
}
