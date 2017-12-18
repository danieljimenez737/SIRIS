<?php

use App\Models\mapper;
use App\Repositories\mapperRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mapperRepositoryTest extends TestCase
{
    use MakemapperTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var mapperRepository
     */
    protected $mapperRepo;

    public function setUp()
    {
        parent::setUp();
        $this->mapperRepo = App::make(mapperRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatemapper()
    {
        $mapper = $this->fakemapperData();
        $createdmapper = $this->mapperRepo->create($mapper);
        $createdmapper = $createdmapper->toArray();
        $this->assertArrayHasKey('id', $createdmapper);
        $this->assertNotNull($createdmapper['id'], 'Created mapper must have id specified');
        $this->assertNotNull(mapper::find($createdmapper['id']), 'mapper with given id must be in DB');
        $this->assertModelData($mapper, $createdmapper);
    }

    /**
     * @test read
     */
    public function testReadmapper()
    {
        $mapper = $this->makemapper();
        $dbmapper = $this->mapperRepo->find($mapper->id);
        $dbmapper = $dbmapper->toArray();
        $this->assertModelData($mapper->toArray(), $dbmapper);
    }

    /**
     * @test update
     */
    public function testUpdatemapper()
    {
        $mapper = $this->makemapper();
        $fakemapper = $this->fakemapperData();
        $updatedmapper = $this->mapperRepo->update($fakemapper, $mapper->id);
        $this->assertModelData($fakemapper, $updatedmapper->toArray());
        $dbmapper = $this->mapperRepo->find($mapper->id);
        $this->assertModelData($fakemapper, $dbmapper->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletemapper()
    {
        $mapper = $this->makemapper();
        $resp = $this->mapperRepo->delete($mapper->id);
        $this->assertTrue($resp);
        $this->assertNull(mapper::find($mapper->id), 'mapper should not exist in DB');
    }
}
