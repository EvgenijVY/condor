<?php


declare(strict_types = 1);

namespace StatisticProvider;

use DTO\StatisticInfo;

interface StatisticProviderInterface
{
    public function getStatisticFor(?\DateTimeImmutable $from = null, ?\DateTimeImmutable $to = null): StatisticInfo;
}