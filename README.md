# Hannah Car - سیستم مدیریت استعلامات خودرو

## 📋 توضیحات پروژه

Hannah Car یک سیستم مدیریت استعلامات خودرو است که با Laravel 11 و Tailwind CSS ساخته شده است. این سیستم امکان ثبت و مدیریت انواع مختلف استعلامات خودرو را فراهم می‌کند.

## 🚀 ویژگی‌ها

- **سیستم وریفای تلفن**: پشتیبانی از SMS و WhatsApp
- **فرم‌های داینامیک**: مدیریت استعلامات از طریق دیتابیس
- **پنل ادمین**: مدیریت کامل کاربران و استعلامات
- **پشتیبانی بین‌المللی**: کد کشور و شماره‌های بین‌المللی
- **سیستم نوتیفیکیشن**: ارسال پیام از طریق WhatsApp
- **رابط کاربری مدرن**: طراحی زیبا با Tailwind CSS

## 📦 نصب و راه‌اندازی

### پیش‌نیازها

- PHP >= 8.2
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (برای assets)

### مراحل نصب

1. **کلون کردن پروژه**
```bash
git clone https://github.com/your-username/hannahcar.git
cd hannahcar
```

2. **نصب وابستگی‌ها**
```bash
composer install
npm install
```

3. **کپی فایل محیط**
```bash
cp .env.example .env
```

4. **تنظیم دیتابیس**
```bash
# در فایل .env تنظیمات دیتابیس را وارد کنید
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hannahcar
DB_USERNAME=root
DB_PASSWORD=
```

5. **تولید کلید اپلیکیشن**
```bash
php artisan key:generate
```

6. **اجرای مایگریشن‌ها**
```bash
php artisan migrate
```

7. **اجرای سیدرها**
```bash
php artisan db:seed
```

8. **ساخت لینک storage**
```bash
php artisan storage:link
```

9. **ساخت assets**
```bash
npm run build
```

10. **اجرای سرور**
```bash
php artisan serve
```

## 🔧 تنظیمات

### تنظیمات WhatsApp
در فایل `.env` تنظیمات زیر را وارد کنید:
```
WHATSAPP_APPKEY=your_app_key
WHATSAPP_AUTHKEY=your_auth_key
```

### تنظیمات SMS
برای ارسال SMS، تنظیمات مربوطه را در `NotificationHelper` اضافه کنید.

## 📁 ساختار پروژه

```
hannahcar/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # کنترلرهای ادمین
│   │   └── Inquiry*         # کنترلرهای استعلامات
│   ├── Models/              # مدل‌های دیتابیس
│   └── Helpers/             # کلاس‌های کمکی
├── resources/views/
│   ├── admin/               # ویوهای ادمین
│   ├── inquiries/           # ویوهای استعلامات
│   └── components/          # کامپوننت‌ها
├── routes/
│   ├── web.php             # مسیرهای عمومی
│   └── admin.php           # مسیرهای ادمین
└── database/
    ├── migrations/          # مایگریشن‌ها
    └── seeders/            # سیدرها
```

## 🎯 انواع استعلامات

1. **خرید خودرو خاص**: درخواست خرید خودروهای خاص
2. **قطعه یدکی خاص**: درخواست قطعات یدکی نایاب
3. **استعلام VIN**: بررسی شماره شناسایی خودرو

## 🔐 دسترسی‌ها

- **پنل ادمین**: `/admin`
- **فرم‌های استعلام**: `/inquiry-forms`
- **لیست استعلامات**: `/inquiries`

## 📞 پشتیبانی

برای پشتیبانی و گزارش مشکلات، لطفاً issue جدید ایجاد کنید.

## 📄 لایسنس

این پروژه تحت لایسنس MIT منتشر شده است.
