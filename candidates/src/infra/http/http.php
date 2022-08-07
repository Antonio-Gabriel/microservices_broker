<?php

use Slim\App;

use Candidates\application\usecases\CreateCategory;
use Candidates\infra\repositories\CategoriesRepository;

return function (App $app) {
    $app->post("/category", function ($req, $res) {

        $createCategory = new CreateCategory(new CategoriesRepository);
        $result = $createCategory->execute("TV");

        // if ($error = $result->message->errorValue()) {
        //     return $res->withStatus(400)->withJson(["error" => $error]);
        // }

        // if ($error = $result->errorValue()) {
        //     return $res->withStatus(400)->withJson(["error" => $error]);
        // }

//            var_dump($result);

        // return $res->withStatus(201)->withJson(["msg" => $result]);
    });
};
