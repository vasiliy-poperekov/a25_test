<?php

namespace App\Dao;

interface PayDao
{
    public const OPTIMAL_SELECT_CHUNK = 100;
    public function pay(int $chunkSize = self::OPTIMAL_SELECT_CHUNK): void;
}
