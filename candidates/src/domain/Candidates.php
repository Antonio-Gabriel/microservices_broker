<?php

namespace Candidates\domain;

use Candidates\common\Result;
use Candidates\domain\types\CandidatesProps;

class Candidates extends Entity
{
    private function __construct(
        public $props,
        protected ?string $uuid = null
    ) {
        parent::__construct($props, $uuid);
    }

    public static function create(CandidatesProps $props, ?string $uuid = null)
    {
        if (empty($props->name) || empty($props->categoryId)) {
            return Result::Fail("Fill a valid payload [name] and [categoryId]");
        }

        $candidate = new Candidates($props, $uuid);

        return Result::Ok($candidate);
    }
}
