<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class CarApiService
{
    protected $baseUrl;
    protected $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.car_api.base_url', 'http://localhost:8000');
        $this->timeout = config('services.car_api.timeout', 30);
    }

    /**
     * بررسی وضعیت API
     */
    public function healthCheck()
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get($this->baseUrl . '/health');

            return $response->successful();
        } catch (Exception $e) {
            Log::error('Car API Health Check Failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * دریافت لیست خودروها
     */
    public function getCars($page = 1, $limit = 100, $synced = null)
    {
        try {
            $params = [
                'page' => $page,
                'limit' => $limit,
            ];

            // اضافه کردن پارامتر synced_only اگر مشخص شده باشد
            if ($synced !== null) {
                $params['synced_only'] = $synced ? 'true' : 'false';
            }

            $response = Http::timeout($this->timeout)
                ->get($this->baseUrl . '/api/cars', $params);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('دریافت خودروها ناموفق: ' . $response->status());
            return null;
        } catch (Exception $e) {
            Log::error('خطا در دریافت خودروها: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * دریافت جزئیات یک خودرو
     */
    public function getCarDetails($carId)
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get($this->baseUrl . '/api/cars/' . $carId);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Car API Car Details Failed: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('Car API Car Details Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * دریافت وضعیت همگام‌سازی
     */
    public function getSyncStatus()
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get($this->baseUrl . '/api/sync/status');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('دریافت وضعیت همگام‌سازی ناموفق: ' . $response->status());
            return null;
        } catch (Exception $e) {
            Log::error('خطا در دریافت وضعیت همگام‌سازی: ' . $e->getMessage());
            return null;
        }
    }

    public function markCarAsSynced($carId)
    {
        try {
            $response = Http::timeout($this->timeout)
                ->post($this->baseUrl . "/api/cars/{$carId}/mark-synced");

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('علامت‌گذاری خودرو به عنوان sync شده ناموفق: ' . $response->status());
            return null;
        } catch (Exception $e) {
            Log::error('خطا در علامت‌گذاری خودرو به عنوان sync شده: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * دریافت جزئیات کامل یک خودرو
     */
    public function getCarFullDetails($carId)
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get($this->baseUrl . '/api/cars/' . $carId . '/full');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Car API Car Full Details Failed: ' . $response->body());
            return null;
        } catch (Exception $e) {
            Log::error('Car API Car Full Details Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * دانلود تصویر
     */
    public function downloadImage($imageUrl)
    {
        try {
            $response = Http::timeout($this->timeout)
                ->get($imageUrl);

            if ($response->successful()) {
                return $response->body();
            }

            Log::error('Car API Image Download Failed: ' . $imageUrl);
            return null;
        } catch (Exception $e) {
            Log::error('Car API Image Download Exception: ' . $e->getMessage());
            return null;
        }
    }
}
