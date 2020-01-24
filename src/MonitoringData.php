<?php

declare(strict_types=1);

namespace Phash;

use DateTimeInterface;

class MonitoringData
{
    private $id;
    private $status;
    private $payload;
    private $idleTimeoutInSeconds;
    private $priority;
    private $date;
    private $path;
    private $tileExpansionIntervalCount;
    private $tileExpansionGrowthExpression;

    public function __construct(
        string $id,
        string $status,
        string $payload,
        int $idleTimeoutInSeconds,
        int $priority,
        DateTimeInterface $date,
        ?string $path
    ) {
        $this->id = $id;
        $this->status = $status;
        $this->payload = $payload;
        $this->idleTimeoutInSeconds = $idleTimeoutInSeconds;
        $this->priority = $priority;
        $this->date = $date;
        $this->path = $path;
    }

    public function setTileExpansionIntervalCount(int $tileExpansionIntervalCount): void
    {
        $this->tileExpansionIntervalCount = $tileExpansionIntervalCount;
    }

    public function setTileExpansionGrowthExpression(string $tileExpansionGrowthExpression): void
    {
        $this->tileExpansionGrowthExpression = $tileExpansionGrowthExpression;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function getIdleTimeoutInSeconds(): int
    {
        return $this->idleTimeoutInSeconds;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getTileExpansionIntervalCount(): ?int
    {
        return $this->tileExpansionIntervalCount;
    }

    public function getTileExpansionGrowthExpression(): ?string
    {
        return $this->tileExpansionGrowthExpression;
    }
}
