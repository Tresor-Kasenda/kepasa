<?php
declare(strict_types=1);

namespace App\Services;

trait RandomValue
{
    public function  generateRandomTransaction(int $values): string
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghilkmnopqrstuvwxyz';
        $randomString = '';
        for ($i = 0; $i < $values; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return strtoupper($randomString);
    }
}
