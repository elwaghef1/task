<?php

namespace App\Doctrine\DBAL\Type;

use App\Enum\DecisionEnum;

class DecisionEnumType extends EnumType
{
    protected function getEnum(): string
    {
        return DecisionEnum::class;
    }

    public function getName(): string
    {
        return 'decision_enum';
    }
}
