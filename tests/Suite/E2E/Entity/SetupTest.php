<?php

declare(strict_types=1);

namespace AmaTeam\ElasticSearch\Test\Suite\E2E\Entity;

use AmaTeam\ElasticSearch\API\ClientFactoryInterface;
use AmaTeam\ElasticSearch\API\MappingInterface;
use AmaTeam\ElasticSearch\Framework\Builder;
use AmaTeam\ElasticSearch\Mapping\Operations as Mappings;
use AmaTeam\ElasticSearch\Test\Support\Allure\AttachmentAware;
use AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business\Department;
use AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business\Employee;
use AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business\Manager;
use AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business\MappingProvider;
use AmaTeam\ElasticSearch\Test\Support\Entity\Acceptance\Business\Organization;
use AmaTeam\ElasticSearch\Test\Support\TestClientFactory;
use Codeception\Test\Unit;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Elasticsearch\Client;
use PHPUnit\Framework\Assert;

class SetupTest extends Unit
{
    use AttachmentAware;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @inheritDoc
     */
    protected function _before()
    {
        $this->clientFactory = new TestClientFactory();
        $this->client = (new TestClientFactory())->getClient();
    }

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass()
    {
        AnnotationRegistry::registerLoader('class_exists');
    }

    public function dataProvider()
    {
        $business = MappingProvider::getMapping();
        return [
            [Department::class, $business['department']],
            [Employee::class, $business['employee']],
            [Manager::class, $business['manager']],
            [Organization::class, $business['organization']],
        ];
    }

    /**
     * @param string $entityName
     * @param MappingInterface $expectation
     *
     * @test
     * @dataProvider dataProvider
     */
    public function shouldCreateExpectedIndex(string $entityName, MappingInterface $expectation)
    {
        $framework = (new Builder())->setClientFactory($this->clientFactory)->build();
        $entity = $framework->getRegistry()->get($entityName);
        $this->addDataAttachment($entity, 'entity');
        $this->addDataAttachment($expectation, 'mapping-expectation');
        $mapping = $entity->getMapping();
        $this->addDataAttachment($mapping, 'mapping-built');
        Assert::assertEquals($expectation, $mapping);
        $indices = $entity->getIndexing()->getWriteIndices();
        $index = reset($indices);
        if ($this->client->indices()->exists(['index' => $index])) {
            $this->client->indices()->delete(['index' => $index]);
        }
        $framework->getOperationsManager()->setUp($entityName);
        $result = $framework->getClient()->indices()->getMapping($index, $entity->getIndexing()->getType());
        $this->addDataAttachment($result, 'mapping-inserted');
        Assert::assertFalse(Mappings::conflict($expectation, $result));
        // second application should not do anything wrong
        $framework->getOperationsManager()->setUp($entityName);
    }
}
