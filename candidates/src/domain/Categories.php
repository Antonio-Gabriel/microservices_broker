<?php

namespace Candidates\domain;

use Candidates\common\Result;
use Candidates\domain\types\CategoriesProps;

class Categories extends Entity
{
    private function __construct(
        public $props,
        protected ?string $uuid = null
    ) {
        parent::__construct($props, $uuid);
    }

    public static function create(CategoriesProps $props, ?string $uuid = null)
    {
        if (empty($props->name)) {
            return Result::Fail("Fill a valid payload [name]");
        }

        $candidate = new Categories($props, $uuid);

        return Result::Ok($candidate);
    }
}
