<?php

declare(strict_types = 1);

namespace Core;

class StatisticLoader
{
    private array $enabledStatisticProviders = [];

    public function __construct()
    {
        $this->loadEnabledStatisticProviders();
    }

    private function loadEnabledStatisticProviders(): void
    {
        $enabledStatisticProvidersNames = ENABLED_STATISTIC_PROVIDERS;
        foreach ($enabledStatisticProvidersNames as $statisticProvidersName) {
            $fullClassNameStatisticProvider = 'StatisticProvider\\' . $statisticProvidersName;
            $this->enabledStatisticProviders[] = new $fullClassNameStatisticProvider();
        }
    }

    public function getEnabledStatisticProviders(): array
    {
        return $this->enabledStatisticProviders;
    }
}