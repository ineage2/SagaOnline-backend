<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

trait CacheTrait
{
    public function getFromCache(string $prefix): mixed
    {
        $cachedData = Cache::get($prefix);

        if ($cachedData) {
            $this->logCache('retrieve', $prefix, $cachedData);
        } else {
            $this->logCache('miss', $prefix);
        }

        return $cachedData;
    }

    public function putInCache(string $prefix, mixed $value): void
    {
        $ttl = now()->addMonths(3);
        Cache::put($prefix, $value, $ttl);
        $this->logCache('store', $prefix, $value);
    }

    private function logCache(string $action, string $prefix, mixed $value = null): void
    {
        $currentTime = Carbon::now()->toDateTimeString();
        switch ($action) {
            case 'retrieve':
                Log::info("Data retrieved from cache with key: {$prefix} at {$currentTime}");
                if ($value !== null) {
                    $sizeInBytes = strlen(serialize($value));
                    $this->logDataSize($sizeInBytes);
                }
                break;
            case 'store':
                Log::info("Data stored in cache with key: {$prefix} at {$currentTime}");
                if ($value !== null) {
                    $sizeInBytes = strlen(serialize($value));
                    $this->logDataSize($sizeInBytes);
                }
                Log::info("Cache TTL set for: 3 months");
                break;
            case 'miss':
                Log::warning("Cache miss for key: {$prefix} at {$currentTime}");
                break;
        }
    }

    private function logDataSize(int $sizeInBytes): void
    {
        $sizeInKB = $sizeInBytes / 1024;
        $sizeInMB = $sizeInKB / 1024;

        Log::info("Size of cached data: {$sizeInBytes} bytes, {$sizeInKB} KB, {$sizeInMB} MB");
    }
}
