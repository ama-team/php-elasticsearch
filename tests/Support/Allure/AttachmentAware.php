<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Support\Allure;

use JMS\Serializer\SerializerBuilder;
use Yandex\Allure\Adapter\Support\AttachmentSupport;

trait AttachmentAware
{
    use AttachmentSupport;

    public function addDataAttachment($value, $title = 'data')
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'ama-team-elasticsearch-');
        $serializer = (new SerializerBuilder())->build();
        $normalized = $serializer->serialize($value, 'yml');
        file_put_contents($tempFile, $normalized);
        $this->addAttachment($tempFile, "$title.yml");
    }
}
