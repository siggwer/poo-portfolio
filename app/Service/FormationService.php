<?php

namespace App\Service;

use App\Repository\FormationRepositoryInterface;

class FormationService
{
    /**
     * @var
     */
    private $formationRepository;

    /**
     * FormationService constructor.
     *
     * @param FormationRepositoryInterface $formationRepository
     */
    public function __construct(FormationRepositoryInterface $formationRepository)
    {
        $this->formationRepository = $formationRepository;
    }

    /**
     * @return array
     */
    public function allFormation(): array
    {
        $allPost = $this->formationRepository->allFormation();
        return $allPost;
    }

}