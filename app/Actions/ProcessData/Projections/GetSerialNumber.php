<?php

namespace App\Actions\ProcessData\Projections;

use App\Actions\Interfaces\GetSerialNumberInterface;

class GetSerialNumber implements GetSerialNumberInterface
{
    public function execute(string $projection): string
    {
        $serial = $this->getSerial();
        while ($projection::where('serial', $serial)->count()) {
            $serial = $this->getSerial();
        }

        return (string) $serial;
    }

    private function getSerial(): int
    {
        return random_int(10000000000, 99999999999);
    }
}
