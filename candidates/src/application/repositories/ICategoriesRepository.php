<?php

namespace Candidates\application\repositories;

use Candidates\domain\Categories;

interface ICategoriesRepository
{
    public function create(Categories $category): string;
    public function findByName(string $name);

    public function list(): array;
}
