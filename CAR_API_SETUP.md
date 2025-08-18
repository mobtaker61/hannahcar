# 🚗 راهنمای نصب و راه‌اندازی API خودرو

## 📋 پیش‌نیازها

- Laravel 10+
- PHP 8.1+
- MySQL/PostgreSQL
- پروژه پایتون با API فعال

## ⚙️ مراحل نصب

### 1. اضافه کردن متغیرهای محیطی

فایل `.env` خود را ویرایش کرده و این خطوط را اضافه کنید:

```env
# Car API Configuration
CAR_API_BASE_URL=http://localhost:8000
CAR_API_TIMEOUT=30
```

### 2. اجرای Migration

```bash
php artisan migrate
```

### 3. تست اتصال به API

```bash
# بررسی وضعیت API
php artisan cars:sync-from-api --check-only

# همگام‌سازی کامل
php artisan cars:sync-from-api

# همگام‌سازی با محدودیت
php artisan cars:sync-from-api --limit=50

# همگام‌سازی اجباری (بروزرسانی همه)
php artisan cars:sync-from-api --force
```

## 🔧 تنظیمات API

### Endpoints مورد نیاز:

- `GET /health` - بررسی وضعیت API
- `GET /api/cars` - دریافت لیست خودروها
- `GET /api/sync/status` - وضعیت همگام‌سازی

### فرمت داده مورد انتظار:

```json
{
  "cars": [
    {
      "id": "12345",
      "brand": "Toyota",
      "model": "Camry",
      "year": 2022,
      "price": 50000,
      "currency": "تومان",
      "status": "used",
      "mileage": 15000,
      "description": "توضیحات خودرو",
      "images": [
        "http://example.com/image1.jpg",
        "http://example.com/image2.jpg"
      ]
    }
  ]
}
```

## 📊 ساختار جداول

### جدول `vehicles`:
- `external_id` - شناسه خارجی از API پایتون
- `brand_id` - ارتباط با جدول برندها
- `model_id` - ارتباط با جدول مدل‌ها
- سایر فیلدهای موجود

### جدول `vehicle_galleries`:
- `vehicle_id` - ارتباط با خودرو
- `image_path` - مسیر تصویر
- `is_featured` - تصویر اصلی
- `sort_order` - ترتیب نمایش

## 🚀 ویژگی‌های سیستم

- ✅ **همگام‌سازی هوشمند**: تشخیص خودروهای جدید و موجود
- 🔄 **بروزرسانی خودکار**: بروزرسانی اطلاعات تغییر یافته
- 🖼️ **دانلود تصاویر**: دریافت و ذخیره تصاویر از API
- 📝 **گزارش کامل**: نمایش آمار عملیات
- 🛡️ **مدیریت خطا**: لاگ و مدیریت خطاها
- ⚡ **پردازش بهینه**: مدیریت حافظه و سرعت

## 🔍 عیب‌یابی

### مشکل: API در دسترس نیست
```bash
# بررسی وضعیت API
php artisan cars:sync-from-api --check-only
```

### مشکل: خطا در دانلود تصاویر
- بررسی دسترسی‌های فایل
- بررسی فضای دیسک
- بررسی لاگ‌ها

### مشکل: خطا در همگام‌سازی
- بررسی ساختار داده API
- بررسی فیلدهای اجباری
- بررسی لاگ‌های خطا

## 📞 پشتیبانی

در صورت بروز مشکل، لاگ‌های سیستم را بررسی کنید:

```bash
tail -f storage/logs/laravel.log
```

## 🔄 بروزرسانی

برای بروزرسانی سیستم:

```bash
composer update
php artisan migrate
php artisan config:cache
php artisan route:cache
```
