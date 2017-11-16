# AmaTeam\ElasticSearch

[![Packagist](https://img.shields.io/packagist/v/ama-team/elasticsearch.svg?style=flat-square)](https://packagist.org/packages/ama-team/elasticsearch)
[![CircleCI/master](https://img.shields.io/circleci/project/github/ama-team/php-elasticsearch/master.svg?style=flat-square)](https://circleci.com/gh/ama-team/php-elasticsearch/tree/master)
[![Coveralls/master](https://img.shields.io/coveralls/github/ama-team/php-elasticsearch/master.svg?style=flat-square)](https://coveralls.io/github/ama-team/php-elasticsearch?branch=master)
[![Scrutinizer/master](https://img.shields.io/scrutinizer/g/ama-team/php-elasticsearch/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ama-team/php-elasticsearch)
[![Code Climate](https://img.shields.io/codeclimate/github/ama-team/elasticsearch.svg?style=flat-square)](https://codeclimate.com/github/ama-team/php-elasticsearch)

This repository is dedicated to bunch of support utilities for 
[ElasticSearch][]: type mapping, automated type mapping, automated type
mapping migration and so on.

At current moment, everything is aimed only for ES 6.0+ compatibility. 

## Installation

```bash
composer require ama-team/elasticsearch
```

## Motivation

While ElasticSearch is a beautiful tool by itself, the developer 
toolchain lacks some instruments for effective work. Two of the most
annoying things are zero-downtime index rotation and runtime index
metadata analysis (you can't decide whether you need to do nested query
until you know what mapping is applied); usually developer can describe
it in application configuration, but it easily gets out of sync and 
requires additional hand-written code. This library aims to simplify 
such work, first of all providing annotations to define your mapping
and indexing options directly in your document classes.

## Usage

Library entry point is `AmaTeam\ElasticSearch\Framework\Builder`, which
helps to create `Framework` instance. Many classes (like normalizer or 
validator), however, may act without additional configuration or
dependencies and can be used for any arbitrary purpose.

Every class that maps directly to a document is called an *entity*,
and class that forms part of a document - an *embeddable*.

### Entity API

Currently only one operation is supported - ensure that target index
exists with required mapping:

```php
<?php
$framework
    ->getEntityClient()
    ->ensureIndexState(MyEntity::class);
```

This will create index if necessary or verify that mapping matches
expectations.

### Mapping

#### API

Entity metadata is fetched using loaders that can be specified on 
framework builder (only annotation loader is currently implemented).
To perform some direct work using mapping, 
`Framework::getMappingManager()` may be used.

#### Annotations

This library is very similar to Doctrine in defining entity metadata:

```php
<?php

use AmaTeam\ElasticSearch\API\Annotation\Entity;
use AmaTeam\ElasticSearch\API\Annotation\Embeddable;
use AmaTeam\ElasticSearch\API\Annotation\Mapping;
use AmaTeam\ElasticSearch\API\Annotation\Mapping\Parameter;

/**
 * Annotation loader distinguishes document classes by Entity annotation
 * 
 * @Entity(writeIndices={"region-write"}, readIndices={"region-read"})
 * 
 * Since this is not ODM (at least yet), indices doesn't mean much - 
 * only writeIndices are used when mapped is applied.
 *
 * Every class may define some default parameters that will be applied
 * unless overridden in holding property. Since this is the root class,
 * nothing will override following parameters:
 *
 * @Parameter\Dynamic(false)
 * @Parameter\Source(true)
 */
class GeoRegion
{
    /**
     * Every class property will be rendered as a mapping property, if
     * it has Type annotation
     * 
     * @Mapping\Type("integer")
     *
     * Properties may have mapping parameters as well:
     * 
     * @Parameter\Index(false)
     */
    private $id;
    /**
     * @Mapping\Type("keyword")
     * @Parameter\Index(false)
     */
    private $title;
    /**
     * The library tries to be as tolerant to camelCase as possible:
     * 
     * @Mapping\Type("geoPoint")
     */
    private $location;
    /** 
     * Whenever property is resembled by a class with it's own mapping,
     * it should be stated by TargetEntity annotation: 
     * 
     * @Mapping\TargetEntity("TrackingLabel")
     * 
     * Since that entity may be reused in different variations, there
     * should be a way to differentiate mapping based on some switch. 
     * Views were implemented to do so: most annotations may specify
     * several views they are active in, so you may turn off or turn
     * on properties, change types and modify parameters for different 
     * views.
     * Views annotation affects only target entity, so if there were
     * other parameters, they would not get 'extended' view unless 
     * this class would be embedded under property with another Views
     * annotation.
     * 
     * Annotations without any views are applied do default view,
     * which serves as parent for all named views.
     * 
     * @Mapping\Views({"extended"})
     *
     * Property annotations have more priority than class annotations, 
     * so this one will override "nested" type specified on 
     * TrackingLabel class.
     * 
     * @Mapping\Type("object")
     */
    private $labels;
    /**
     * @Mapping\TargetEntity("GeoRegion")
     * 
     * By default, views are appended to the list of views already
     * specified in current context, but they may be replaced by
     * specifying correct mode
     * 
     * @Mapping\Views({"short"}, mode="REPLACE")
     * 
     * Entities may be embedded one into another, and that can easily 
     * trigger unwanted infinite recursion. To prevent it, 
     * IgnoredProperty annotation tells that this property doesn't
     * exist under 'short' view - which is switched on above.
     * 
     * @Mapping\IgnoredProperty(views={"short"}) 
     */
    private $parent;
}

/**
 * This is not a full-blown document, just a class that other classes
 * embed in. It has to be marked as well, but since it doesn't need 
 * any indexing information, you can just use Embeddable annotation.
 * 
 * @Embeddable
 * @Mapping\Type("nested")
 * @Parameter\Dynamic(false)
 */
class TrackingLabel
{
    /**
     * @Mapping\Type("keyword")
     * @Parameter\DocValues(true)
     */
    private $domain;
    /**
     * @Mapping\Type("keyword")
     * @Parameter\DocValues(true)
     */
    private $category;
    /**
     * @Mapping\Type("keyword")
     * @Parameter\DocValues(true)
     */
    private $identifier;
    /**
     * Again, this property is included only when class is referenced 
     * with "extended" view
     * 
     * @Mapping\Type("text", views={"extended"})
     * @Mapping\Index("false")
     */
    private $description;
}
```

At this level, every class and property have their own configurations,
and each state may consist of several views, while in fact it should 
be just types with optional properties of other types. This is done
using following algorithm (as found in `Mapping\Manager` methods):

- Annotations are analyzed to build descriptor for every class
- Inheritance chain is determined for analyzed class, and whole chain 
is compressed into one class mapping. Inheritance may be controlled 
with `@Entity`, `@Embeddable` and `@IgnoredParentProperties` 
annotations.
- After that, views for current class are determined. They are 
compressed to a single view as well, after which default parameters
are set and ignored properties are defined.
- Then properties are iterated one by one, with same compress operation
for views. If a target entity is found on property, the algorithm 
recurses, then overrides result with computed property parameters: if 
class had mapping type A as default, setting type B on property will
override type A.
- Results are collected as `MappingInterface` instance, which just
has certain type, parameters and properties that are `MappingInterface`
instances as well.
- Chances are that this mapping will have camelCased stuff inside, as
well as some extra parameters from default view, so `Normalizer` is
run over it.
- At last step, `Validator` takes action to validate the result. It
can also be used to validate mapping even if you collect it from
other place (say, YAML configuration files). 

After clean `MappingInterface` instance had been obtained, 
`Mapping::asArray` will convert such result into array that 
may be inserted in ES.

## Current status

This library was built in a hurry and lacks proper testing as well as
architecture. It is far far from perfect and some issues are expected,
hopefully i'll have time to fix things in 0.2.0.

### What doesn't this library do yet?

- Automatic entity detection (but planned)
- Automatic query assembly using mapping information
(i.e. use mapping information to inject nested query where necessary)
- Automatic zero downtime mapping migration and reindexing (but 
planned)
- Fancy CLI things like mapping dump, CLI-based migration,
etc., etc. (but planned)
- ODM (not even planned)
- Mapping parameters defaults (dunno if planned)
- Declarative mapping in configuration files rather than annotations
(planned in next millennia)
- Analyzer configuration (but planned in distant future)

## Contributing

Feel free to send pull requests to **dev** branch. That's where next 
release is cultivated.

## Dev branch state

[![CircleCI/dev](https://img.shields.io/circleci/project/github/ama-team/php-elasticsearch/dev.svg?style=flat-square)](https://circleci.com/gh/ama-team/php-elasticsearch/tree/dev)
[![Coveralls/dev](https://img.shields.io/coveralls/github/ama-team/php-elasticsearch/dev.svg?style=flat-square)](https://coveralls.io/github/ama-team/php-elasticsearch?branch=dev)
[![Scrutinizer/dev](https://img.shields.io/scrutinizer/g/ama-team/php-elasticsearch/dev.svg?style=flat-square)](https://scrutinizer-ci.com/g/ama-team/php-elasticsearch)

## License

MIT License, AMA Team 2017

  [ElasticSearch]: https://elastic.co
