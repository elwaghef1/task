<?php

namespace App\Doctrine\DBAL\Type;

use App\Enum\MaterialEnum;

class MaterialEnumType extends EnumType
{
    protected function getEnum(): string
    {
        return MaterialEnum::class;
    }

    public function getName(): string
    {
        return 'material_enum';
    }
}
