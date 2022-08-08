<?php

namespace Votes\domain;

use Votes\common\Result;
use Votes\domain\types\VoteProps;

class Voter extends Entity
{
    private function __construct(
        public $props,
        protected ?string $uuid = null
    ) {
        parent::__construct($props, $uuid);
    }

    public static function create(VoteProps $props, ?string $uuid = null)
    {
        if (
            empty($props->voter) ||
            empty($props->voterEmail) ||
            empty($props->candidateName) ||
            empty($props->candidateId)
        ) {
            return Result::Fail("Check the fill data");
        }

        $voter = new Voter($props, $uuid);

        return Result::Ok($voter);
    }
}
