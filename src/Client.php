<?php

declare(strict_types=1);

namespace Phash;

use Exception;

interface Client
{
    public const API_URI = '/api/monitoring/data';

    /**
     * @throws Exception
     */
    public function push(MonitoringData $monitoringData): void;
}
