<?php

namespace App\Doctrine\DBAL\Type;

use App\Enum\TypeEnum;

class TypeEnumType extends EnumType
{
    protected function getEnum(): string
    {
        return TypeEnum::class;
    }

    public function getName(): string
    {
        return 'type_enum';
    }
}
