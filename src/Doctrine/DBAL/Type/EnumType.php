<?php

namespace App\Doctrine\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

abstract class EnumType extends Type
{
    /**
     * @return class-string
     */
    abstract protected function getEnum(): string;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        $enum = $this->getEnum();
        $cases = array_map(
            fn ($enumItem) => "'{$enumItem->value}'",
            $enum::cases()
        );

        return sprintf('ENUM(%s)', implode(', ', $cases));
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_string($value)) {
            $enumClass = $this->getEnum();

            return $enumClass::from($value);
        }

        return $value;
    }

    public function convertToDatabaseValue($enum, AbstractPlatform $platform)
    {
        if (isset($enum)) {
            if (is_string($enum)) {
                return $enum;
            }

            return $enum->value;
        }

        return null;
    }
}
