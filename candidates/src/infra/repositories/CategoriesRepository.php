<?php

namespace Candidates\infra\repositories;

use Category;
use CategoryQuery;

use Candidates\domain\Categories;
use Candidates\application\repositories\ICategoriesRepository;

class CategoriesRepository implements ICategoriesRepository
{
    public function create(Categories $category): string
    {
        $categorySchema = new Category();
        $categorySchema->setId($category->getId());
        $categorySchema->setName($category->props->name);

        $categorySchema->save();

        return $categorySchema->getId();
    }

    public function findByName(string $name)
    {
        return CategoryQuery::create()->findOneByName($name);
    }

    public function list(): array
    {
        $categories = [];
        foreach (CategoryQuery::create()->find() as $value) {
            array_push($categories, [
                "id"    =>  $value->getId(),
                "name"  =>  $value->getName(),
            ]);
        }

        return $categories;
    }
}
