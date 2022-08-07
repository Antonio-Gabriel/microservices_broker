<?php

use Slim\App;

use Candidates\application\usecases\CreateCategory;
use Candidates\infra\repositories\CategoriesRepository;

return function (App $app) {
    $app->post("/category", function ($req, $res) {

        $createCategory = new CreateCategory(new CategoriesRepository);

        try {
            $result = $createCategory->execute($req->getParsedBody()["name"]);

            return $res->withStatus(200)->withJson(["data" => [
                "id" => $result
            ]]);
        } catch (\Exception $e) {
            return $res->withStatus(400)->withJson(["error" => $e->getMessage()]);
        }    
    });
};
