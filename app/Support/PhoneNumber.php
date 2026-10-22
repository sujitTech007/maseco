<?php

namespace App\Support;

class PhoneNumber
{
    public static function normalizeLocal(string $phone, ?string $countryCode = null): string
    {
        $trimmedPhone = trim($phone);
        $digits = preg_replace('/\D+/', '', $trimmedPhone) ?? '';

        if ($countryCode && (str_starts_with($trimmedPhone, '+') || str_starts_with($trimmedPhone, '00'))) {
            $callingCode = preg_replace('/\D+/', '', $countryCode) ?? '';
            if ($callingCode !== '' && str_starts_with($digits, $callingCode)) {
                $digits = substr($digits, strlen($callingCode));
            } elseif (str_starts_with($trimmedPhone, '00')) {
                $digits = substr($digits, 2);
            }
        }

        return $digits;
    }

    public static function toE164(?string $countryCode, string $phone): string
    {
        $trimmedPhone = trim($phone);
        if (str_starts_with($trimmedPhone, '+')) {
            return '+' . self::normalizeLocal($trimmedPhone);
        }
        if (str_starts_with($trimmedPhone, '00')) {
            return '+' . substr(self::normalizeLocal($trimmedPhone), 2);
        }

        $normalizedPhone = self::normalizeLocal($trimmedPhone);
        $callingCode = self::normalizeLocal($countryCode ?: '+1');
        $callingCode = $callingCode !== '' ? $callingCode : '1';
        $localNumber = ltrim($normalizedPhone, '0');

        return '+' . $callingCode . $localNumber;
    }
}
