<?php

namespace App\Support;

class DocumentoBr
{
    public static function apenasDigitos(?string $valor): ?string
    {
        if ($valor === null || $valor === '') {
            return null;
        }

        $digitos = preg_replace('/\D/', '', $valor);

        return $digitos !== '' ? $digitos : null;
    }

    public static function formatar(?string $valor): ?string
    {
        $digitos = self::apenasDigitos($valor);

        if ($digitos === null) {
            return null;
        }

        if (strlen($digitos) <= 11) {
            return self::formatarCpf($digitos);
        }

        return self::formatarCnpj($digitos);
    }

    public static function formatarCpf(string $digitos): string
    {
        $digitos = str_pad(substr($digitos, 0, 11), 11, '0', STR_PAD_LEFT);

        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $digitos,
        );
    }

    public static function formatarCnpj(string $digitos): string
    {
        $digitos = str_pad(substr($digitos, 0, 14), 14, '0', STR_PAD_LEFT);

        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
            '$1.$2.$3/$4-$5',
            $digitos,
        );
    }

    public static function formatarTelefone(?string $valor): ?string
    {
        $digitos = self::apenasDigitos($valor);

        if ($digitos === null) {
            return null;
        }

        if (strlen($digitos) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digitos);
        }

        if (strlen($digitos) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digitos);
        }

        return $valor;
    }
}
