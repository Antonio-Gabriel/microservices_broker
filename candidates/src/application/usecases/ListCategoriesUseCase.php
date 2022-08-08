<?php

namespace Candidates\application\usecases;

use Candidates\application\repositories\ICategoriesRepository;

class ListCategoriesUseCase
{
    public function __construct(
        private ICategoriesRepository $categoriesRepository
    ) {
    }

    public function execute()
    {
        return $this->categoriesRepository->list();
    }
}
