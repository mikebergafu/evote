<?php

namespace App\Services;

class DeviceFingerprint
{
    public static function generate(): string
    {
        $components = [
            request()->userAgent(),
            request()->ip(),
            request()->server('HTTP_ACCEPT_LANGUAGE'),
            request()->server('HTTP_ACCEPT_ENCODING'),
        ];

        return hash('sha256', implode('|', $components));
    }

    public static function verify(string $storedFingerprint): bool
    {
        return hash_equals($storedFingerprint, self::generate());
    }
}
