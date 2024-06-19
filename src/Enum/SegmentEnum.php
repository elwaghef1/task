<?php

namespace App\Enum;

enum SegmentEnum: string
{
    case Segment1 = 'Segment1';
    case Segment2 = 'Segment2';
    case Segment3 = 'Segment3';

    public function toString(): string
    {
        return $this->value;
    }
}
