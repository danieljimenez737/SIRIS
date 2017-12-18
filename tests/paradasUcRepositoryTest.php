<?php

use App\Models\paradasUc;
use App\Repositories\paradasUcRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class paradasUcRepositoryTest extends TestCase
{
    use MakeparadasUcTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var paradasUcRepository
     */
    protected $paradasUcRepo;

    public function setUp()
    {
        parent::setUp();
        $this->paradasUcRepo = App::make(paradasUcRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateparadasUc()
    {
        $paradasUc = $this->fakeparadasUcData();
        $createdparadasUc = $this->paradasUcRepo->create($paradasUc);
        $createdparadasUc = $createdparadasUc->toArray();
        $this->assertArrayHasKey('id', $createdparadasUc);
        $this->assertNotNull($createdparadasUc['id'], 'Created paradasUc must have id specified');
        $this->assertNotNull(paradasUc::find($createdparadasUc['id']), 'paradasUc with given id must be in DB');
        $this->assertModelData($paradasUc, $createdparadasUc);
    }

    /**
     * @test read
     */
    public function testReadparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $dbparadasUc = $this->paradasUcRepo->find($paradasUc->id);
        $dbparadasUc = $dbparadasUc->toArray();
        $this->assertModelData($paradasUc->toArray(), $dbparadasUc);
    }

    /**
     * @test update
     */
    public function testUpdateparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $fakeparadasUc = $this->fakeparadasUcData();
        $updatedparadasUc = $this->paradasUcRepo->update($fakeparadasUc, $paradasUc->id);
        $this->assertModelData($fakeparadasUc, $updatedparadasUc->toArray());
        $dbparadasUc = $this->paradasUcRepo->find($paradasUc->id);
        $this->assertModelData($fakeparadasUc, $dbparadasUc->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $resp = $this->paradasUcRepo->delete($paradasUc->id);
        $this->assertTrue($resp);
        $this->assertNull(paradasUc::find($paradasUc->id), 'paradasUc should not exist in DB');
    }
}
