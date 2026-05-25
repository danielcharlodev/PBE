<?php

namespace App\Support;

class SenaiBrand
{
    private static ?string $logoPath = null;

    private static ?string $faviconPath = null;

    public static function logoPath(): string
    {
        if (self::$logoPath !== null) {
            return self::$logoPath;
        }

        $candidates = [
            'logo-senai.jpg',
            'logo-senai.jpeg',
            'logo-senai.jpge',
            'logo-senai.webp',
            'logo-senai.png',
            'senai-logo.jpg',
            'senai-logo.jpeg',
            'senai-logo.png',
            'senai-logo.svg',
            'logo-small.svg',
        ];

        return self::$logoPath = self::resolveExisting('images', $candidates, 'images/logo-senai.jpg');
    }

    public static function faviconPath(): string
    {
        if (self::$faviconPath !== null) {
            return self::$faviconPath;
        }

        $candidates = [
            'logo-mall.svg',
            'logo-small.svg',
        ];

        return self::$faviconPath = self::resolveExisting('images', $candidates, 'images/logo-mall.svg');
    }

    public static function logoUrl(): string
    {
        return asset(self::logoPath());
    }

    public static function faviconUrl(): string
    {
        return asset(self::faviconPath());
    }

    /**
     * @param  list<string>  $candidates
     */
    private static function resolveExisting(string $folder, array $candidates, string $default): string
    {
        $dir = public_path($folder);

        if (! is_dir($dir)) {
            return $default;
        }

        foreach ($candidates as $file) {
            if (file_exists($dir.DIRECTORY_SEPARATOR.$file)) {
                return $folder.'/'.$file;
            }
        }

        return $default;
    }
}
