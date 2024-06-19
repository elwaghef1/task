<?php

namespace App\Enum;

enum DecisionEnum: string
{
    case Decision1 = 'APPROVED';
    case Decision2 = 'REFUSED';

    public function toString(): string
    {
        return $this->value;
    }
}
