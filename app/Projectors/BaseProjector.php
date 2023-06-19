<?php

namespace App\Projectors;

use Illuminate\Support\Str;
use ReflectionClass;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\Projections\Projection;

class BaseProjector extends Projector
{
    protected function getNewProjection(): Projection
    {
        return new $this->projection();
    }

    protected function getWritable(Projection|null $projection = null): Projection
    {
        $projection = $this->getProjection($projection);

        return $projection->writeable();
    }

    protected function setAttributes(object $attributes, Projection $projection): Projection
    {
        $reflect = new ReflectionClass(get_class($attributes));
        foreach($reflect->getProperties() as $property) {
            $propertyName = Str::snake($property->getName());
            $projection->$propertyName = $property->getValue($attributes);
        }

        return $projection;
    }

    protected function project(object $attributes, Projection|null $projection = null): Projection
    {
        $projection = $this->setAttributes($attributes, $this->getWritable($projection));
        $projection->save();

        return $projection;
    }

    protected function getProjection(Projection|null $projection = null): Projection
    {
        if ($projection ===  null) {
            $projection = $this->getNewProjection();
        }

        return $projection;
    }

    protected function findByUuid(string $uuid): Projection
    {
        return $this->projection::findOrFail($uuid);
    }
}
