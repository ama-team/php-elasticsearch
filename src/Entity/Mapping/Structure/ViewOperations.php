<?php

namespace AmaTeam\ElasticSearch\Entity\Mapping\Structure;

use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\View;
use AmaTeam\ElasticSearch\API\Entity\Mapping\Structure\ViewInterface;

class ViewOperations
{
    public static function merge(ViewInterface... $views): View
    {
        $target = new View();
        foreach ($views as $view) {
            if ($view->getType()) {
                $target->setType($view->getType());
            }
            foreach ($view->getParameters() as $parameter => $value) {
                $target->setParameter($parameter, $value);
            }
            foreach ($view->getIgnoredProperties() as $property) {
                $target->addIgnoredProperty($property);
            }
            foreach ($view->getExistingProperties() as $property) {
                $target->forgetIgnoredProperty($property);
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
