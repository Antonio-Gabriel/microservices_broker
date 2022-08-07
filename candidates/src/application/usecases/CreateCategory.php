<?php

namespace Candidates\application\usecases;

use Candidates\common\Log;
use Candidates\domain\Categories;
use Candidates\domain\types\CategoriesProps;
use Candidates\domain\exceptions\CategoryAlreadyExists;
use Candidates\application\repositories\ICategoriesRepository;

class CreateCategory
{
    public function __construct(
        private ICategoriesRepository $categoriesRepository
    ) {
    }

    public function execute(string $name): mixed
    {
        $categoryAlreadyExists = $this->categoriesRepository->findByName($name);

        if ($categoryAlreadyExists) {
            // Log::set("Category [{$name}] already exists!", "error", [
            //     "name" => $name
            // ]);

            $errpr = new CategoryAlreadyExists("Category [{$name}] already exists!");

            var_dump($errpr);
            //return ;
        }

        // $category = Categories::create(new CategoriesProps($name));

        // if ($category->errorValue()) {
        //     return $category;
        // }

        // $result = $this->categoriesRepository->create($category->getValue());

        // return $result;
    }
}
