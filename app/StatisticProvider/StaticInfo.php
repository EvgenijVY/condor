<?php

declare(strict_types=1);

namespace StatisticProvider;

use DTO\StatisticInfo;

class StaticInfo implements StatisticProviderInterface
{
    public function getStatisticFor(?\DateTimeImmutable $from = null, ?\DateTimeImmutable $to = null): StatisticInfo
    {
        return new StatisticInfo('Static', 150);
    }
}