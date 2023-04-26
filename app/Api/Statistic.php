<?php

declare(strict_types=1);

namespace Api;

use Core\AbstractController;
use Core\Error;
use Core\StatisticAgregator;
use Core\StatisticLoader;
use Core\TypeConverter;

class Statistic extends AbstractController
{
    public static function getAll(): void
    {
        $dataFrom = filter_input_fix(INPUT_GET, 'from');
        $dataTo = filter_input_fix(INPUT_GET, 'to');
        try {
            $from = ($dataFrom) ? TypeConverter::stringToDataTimeImmutable($dataFrom) : null;
            $to = ($dataTo) ? TypeConverter::stringToDataTimeImmutable($dataTo) : null;
        } catch (\Exception $exception) {
            (new Error(400, $exception->getMessage()))->getResponse();
        }

        $statisticLoader = new StatisticLoader();
        $statisticAgregator = new StatisticAgregator();
        $statisticAgregator
            ->setStatisticProviders($statisticLoader->getEnabledStatisticProviders())
            ->getData($from, $to);

        $response = [
            'error' => $statisticAgregator->hasErrors(),
            'message' => implode(PHP_EOL, $statisticAgregator->getErrors()),
            'data' => $statisticAgregator->getStatistic(),
        ];
        echo json_encode($response);
    }
}