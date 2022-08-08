<?php

namespace Candidates\application\usecases;

use Candidates\common\Log;
use Candidates\domain\Categories;
use Candidates\domain\types\CategoriesProps;
use Candidates\application\repositories\ICategoriesRepository;
use Candidates\domain\exceptions\CategoryAlreadyExistsException;

class CreateCategoryUseCase
{
    public function __construct(
        private ICategoriesRepository $categoriesRepository
    ) {
    }

    public function execute(string $name)
    {
        $category = Categories::create(new CategoriesProps($name));

        if ($error = $category->errorValue()) {
            throw new \Exception($error);
        }

        $categoryAlreadyExists = $this->categoriesRepository->findByName($name);

        if ($categoryAlreadyExists) {
            Log::set("Category [{$name}] already exists!", "error", [
                "name" => $name
            ]);

            throw new CategoryAlreadyExistsException("Category [{$name}] already exists!");
        }

        $result = $this->categoriesRepository->create($category->getValue());

        return $result;
    }
}
