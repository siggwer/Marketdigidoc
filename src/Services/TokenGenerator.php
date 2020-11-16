<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Class TokenGenerator.
 */
class TokenGenerator
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return md5(uniqid('', true));
    }
}