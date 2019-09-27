<?php

declare(strict_types=1);

namespace Phash;

use Exception;

interface Client
{
    /**
     * @throws Exception
     */
    public function push(MonitoringData $monitoringData): void;
}
