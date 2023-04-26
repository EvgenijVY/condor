<?php

declare(strict_types=1);

namespace StatisticProvider;

use DTO\StatisticInfo;

class StaticInfoWithError implements StatisticProviderInterface
{
    public function getStatisticFor(?\DateTimeImmutable $from = null, ?\DateTimeImmutable $to = null): StatisticInfo
    {
        throw new \Exception('We have error on StaticInfoWithError, you can of this in config.php');
    }
}