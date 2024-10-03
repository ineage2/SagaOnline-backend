<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;
trait ExecutionTimeLoggerTrait
{
    private float $startTime;

    public function startExecution(): void
    {
        $this->startTime = microtime(true);
    }

    public function logExecutionTime(string $methodName): void
    {
        $endTime = microtime(true);
        Log::info("Execution time for {$methodName} = " . ($endTime - $this->startTime) . ' seconds');
    }
}
