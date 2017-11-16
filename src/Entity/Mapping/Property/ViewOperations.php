<?php

namespace AmaTeam\ElasticSearch\Entity\Mapping\Property;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\View;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Property\ViewInterface;

class ViewOperations
{
    public static function merge(ViewInterface... $views): View
    {
        $target = new View();
        foreach ($views as $view) {
            $target
                ->setChildViews($view->getChildViews())
                ->setAppendChildViews($view->shouldAppendChildViews());
            if ($view->getType()) {
                $target->setType($view->getType());
            }
            if ($view->getTargetEntity()) {
                $target->setTargetEntity($view->getTargetEntity());
            }
            foreach ($view->getParameters() as $parameter => $value) {
                $target->setParameter($parameter, $value);
            }
        }
        return $target;
    }

    public static function from(ViewInterface $view): View
    {
        return static::merge($view);
    }

    public static function toMutable(ViewInterface $view): View
    {
        return $view instanceof View ? $view : static::from($view);
    }
}
