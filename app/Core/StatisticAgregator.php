<?php

declare(strict_types=1);

namespace Core;

use StatisticProvider\StatisticProviderInterface;

class StatisticAgregator
{
    private array $statisticProviders = [];
    private array $statistic = [];
    private array $errors = [];

    /** @param StatisticProviderInterface[] $statisticProviders */
    public function setStatisticProviders(array $statisticProviders): self
    {
        $this->statisticProviders = $statisticProviders;

        return $this;
    }

    public function getData(\DateTimeImmutable $from = null, \DateTimeImmutable $to = null): void
    {
        foreach ($this->statisticProviders as $statisticProvider) {
            /** @var StatisticProviderInterface $statisticProvider */
            try {
                $statisticInfo = $statisticProvider->getStatisticFor($from, $to);
                $this->statistic[$statisticInfo->getName()] = $statisticInfo->getCount();
            } catch (\Exception $exception) {
                $this->errors[] = $exception->getMessage();
            }
        }
    }

    public function getStatistic(): array
    {
        return $this->statistic;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return boolval(count($this->errors));
    }
}