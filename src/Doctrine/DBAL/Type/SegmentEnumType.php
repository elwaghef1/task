<?php

namespace App\Doctrine\DBAL\Type;


use App\Enum\SegmentEnum;

class SegmentEnumType extends EnumType
{
    protected function getEnum(): string
    {
        return SegmentEnum::class;
    }

    public function getName(): string
    {
        return 'segment_enum';
    }
}
