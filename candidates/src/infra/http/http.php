<?php

use Slim\App;

use Candidates\infra\repositories\CandidatesRepository;
use Candidates\infra\repositories\CategoriesRepository;

use Candidates\application\usecases\ListCandidatesUseCase;
use Candidates\application\usecases\ListCategoriesUseCase;

use Candidates\application\usecases\CreateCategoryUseCase;
use Candidates\application\usecases\CreateCandidateUseCase;
use Candidates\application\usecases\VoteUseCase;

return function (App $app) {
    $app->post("/categories", function ($req, $res) {

        $createCategory = new CreateCategoryUseCase(new CategoriesRepository);

        try {
            $result = $createCategory->execute($req->getParsedBody()["name"]);

            return $res->withStatus(200)->withJson(["data" => [
                "id" => $result
            ]]);
        } catch (\Exception $e) {
            return $res->withStatus(400)->withJson(["error" => $e->getMessage()]);
        }
    });

    $app->get("/categories", function ($req, $res) {

        $categories = new ListCategoriesUseCase(new CategoriesRepository);

        return $res->withStatus(200)->withJson($categories->execute());
    });

    // Candidates routes
    $app->post("/candidates", function ($req, $res) {

        $createCandidate = new CreateCandidateUseCase(new CandidatesRepository);

        try {
            $result = $createCandidate->execute($req->getParsedBody()["name"], $req->getParsedBody()["categoryId"]);

            return $res->withStatus(200)->withJson(["data" => [
                "id" => $result
            ]]);
        } catch (\Exception $e) {
            return $res->withStatus(400)->withJson(["error" => $e->getMessage()]);
        }
    });

    $app->get("/candidates", function ($req, $res) {
        $candidates = new ListCandidatesUseCase(new CandidatesRepository);

        return $res->withStatus(200)->withJson($candidates->execute());
    });

    $app->post("/vote", function ($req, $res) {
        $vote = new VoteUseCase(new CandidatesRepository());

        try {
            $vote->execute(
                $req->getParsedBody()["candidateId"],
                $req->getParsedBody()["voter"],
                $req->getParsedBody()["voterEmail"]
            );
        } catch (\Exception $e) {
            return $res->withStatus(400)->withJson(["error" => $e->getMessage()]);
        }
    });
};
