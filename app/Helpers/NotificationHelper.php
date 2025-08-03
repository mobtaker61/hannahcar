<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationHelper
{
    /**
     * ارسال پیام به کانال موردنظر
     * @param string $channel (sms|whatsapp|telegram|email)
     * @param string $to
     * @param string $message
     * @param array $options (مانند فایل یا subject)
     * @return array [success=>bool, message=>string, data=>mixed]
     */
    public static function send($channel, $to, $message, $options = [])
    {
        switch ($channel) {
            case 'sms':
                return self::sendSms($to, $message);
            case 'whatsapp':
                return self::sendWhatsapp($to, $message, $options);
            case 'telegram':
                return self::sendTelegram($to, $message, $options);
            case 'email':
                return self::sendEmail($to, $message, $options);
            default:
                return ['success' => false, 'message' => 'کانال نامعتبر است'];
        }
    }

    public static function sendSms($to, $message)
    {
        // برای تست، کد را در لاگ ذخیره می‌کنیم
        Log::info('SMS Code', [
            'to' => $to,
            'message' => $message,
            'code' => preg_replace('/[^0-9]/', '', $message)
        ]);

        // در محیط production، اینجا کد ارسال SMS واقعی قرار می‌گیرد
        // مثال: استفاده از سرویس‌های SMS مانند کاوه‌نگار، ملی پیامک، و غیره

        return ['success' => true, 'message' => 'کد SMS ارسال شد'];
    }

    public static function sendWhatsapp($to, $message, $options = [])
    {
        $appkey = SettingHelper::get('whatsapp_appkey');
        $authkey = SettingHelper::get('whatsapp_authkey');
        $file = $options['file'] ?? null;
        $url = 'https://ronibot.com/api/create-message';
        $fields = [
            'appkey' => $appkey,
            'authkey' => $authkey,
            'to' => $to,
            'message' => $message,
            'sandbox' => 'false',
        ];
        if ($file) {
            $fields['file'] = $file;
        }
        // ارسال با multipart/form-data
        try {
            if ($file) {
                $response = Http::attach(
                    'file',
                    fopen($file, 'r'),
                    basename($file)
                )
                ->asMultipart()
                ->post($url, $fields);
            } else {
                $response = Http::asMultipart()->post($url, $fields);
            }
            Log::info('WhatsApp Request', ['fields' => $fields]);
            Log::info('WhatsApp Response', ['body' => $response->body(), 'status' => $response->status()]);
            if ($response->ok() && ($response['message_status'] ?? '') === 'Success') {
                return ['success' => true, 'message' => 'ارسال موفق', 'data' => $response->json()];
            }
            return ['success' => false, 'message' => 'ارسال واتساپ ناموفق', 'data' => $response->json()];
        } catch (\Exception $e) {
            Log::error('WhatsApp Exception', ['error' => $e->getMessage(), 'fields' => $fields]);
            return ['success' => false, 'message' => 'خطا در ارسال واتساپ: ' . $e->getMessage()];
        }
    }

    public static function sendTelegram($to, $message, $options = [])
    {
        $botToken = SettingHelper::get('telegram_bot_token');
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $payload = [
            'chat_id' => $to,
            'text' => $message,
        ];
        $response = Http::asJson()->post($url, $payload);
        if ($response->ok() && ($response['ok'] ?? false)) {
            return ['success' => true, 'message' => 'ارسال موفق', 'data' => $response->json()];
        }
        return ['success' => false, 'message' => 'ارسال تلگرام ناموفق', 'data' => $response->json()];
    }

    public static function sendEmail($to, $message, $options = [])
    {
        $subject = $options['subject'] ?? 'پیام جدید';
        try {
            Mail::raw($message, function ($mail) use ($to, $subject) {
                $mail->to($to)->subject($subject);
            });
            return ['success' => true, 'message' => 'ایمیل با موفقیت ارسال شد'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'خطا در ارسال ایمیل: ' . $e->getMessage()];
        }
    }
}
