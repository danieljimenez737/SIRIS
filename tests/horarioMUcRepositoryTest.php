<?php

use App\Models\horarioMUc;
use App\Repositories\horarioMUcRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class horarioMUcRepositoryTest extends TestCase
{
    use MakehorarioMUcTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var horarioMUcRepository
     */
    protected $horarioMUcRepo;

    public function setUp()
    {
        parent::setUp();
        $this->horarioMUcRepo = App::make(horarioMUcRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatehorarioMUc()
    {
        $horarioMUc = $this->fakehorarioMUcData();
        $createdhorarioMUc = $this->horarioMUcRepo->create($horarioMUc);
        $createdhorarioMUc = $createdhorarioMUc->toArray();
        $this->assertArrayHasKey('id', $createdhorarioMUc);
        $this->assertNotNull($createdhorarioMUc['id'], 'Created horarioMUc must have id specified');
        $this->assertNotNull(horarioMUc::find($createdhorarioMUc['id']), 'horarioMUc with given id must be in DB');
        $this->assertModelData($horarioMUc, $createdhorarioMUc);
    }

    /**
     * @test read
     */
    public function testReadhorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $dbhorarioMUc = $this->horarioMUcRepo->find($horarioMUc->id);
        $dbhorarioMUc = $dbhorarioMUc->toArray();
        $this->assertModelData($horarioMUc->toArray(), $dbhorarioMUc);
    }

    /**
     * @test update
     */
    public function testUpdatehorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $fakehorarioMUc = $this->fakehorarioMUcData();
        $updatedhorarioMUc = $this->horarioMUcRepo->update($fakehorarioMUc, $horarioMUc->id);
        $this->assertModelData($fakehorarioMUc, $updatedhorarioMUc->toArray());
        $dbhorarioMUc = $this->horarioMUcRepo->find($horarioMUc->id);
        $this->assertModelData($fakehorarioMUc, $dbhorarioMUc->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletehorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $resp = $this->horarioMUcRepo->delete($horarioMUc->id);
        $this->assertTrue($resp);
        $this->assertNull(horarioMUc::find($horarioMUc->id), 'horarioMUc should not exist in DB');
    }
}
