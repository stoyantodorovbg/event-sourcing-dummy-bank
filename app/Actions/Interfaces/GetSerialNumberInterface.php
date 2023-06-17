<?php

namespace App\Actions\Interfaces;

interface GetSerialNumberInterface
{
    /**
     * Get serial number for an entity
     *
     * @param string $projection
     * @return string
     */
    public function execute(string $projection): string;
}
