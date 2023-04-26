<?php

declare(strict_types = 1);

namespace Core;

class TypeConverter
{
    public static function stringToDataTimeImmutable(string $date = null, string $format = 'Y-m-d'): ?\DateTimeImmutable
    {
        $donvertedDate = \DateTimeImmutable::createFromFormat($format, $date);
        if (!($donvertedDate instanceof \DateTimeImmutable)) {
            throw new \Exception("Wrong date format");
        }
        return $donvertedDate;
    }
}