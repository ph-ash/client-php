<?php

declare(strict_types=1);

namespace Phash;

use DateTimeInterface;
use RuntimeException;

class MonitoringData
{
    public const STATUS_OK = 'ok';
    public const STATUS_ERROR = 'error';

    private const STATUSES = [self::STATUS_ERROR, self::STATUS_OK];

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
        if (!in_array($status, self::STATUSES, true)) {
            throw new RuntimeException(sprintf('status must be one of [%s]', implode(',', self::STATUSES)));
        }
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
