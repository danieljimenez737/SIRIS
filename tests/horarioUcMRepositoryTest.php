<?php

use App\Models\horarioUcM;
use App\Repositories\horarioUcMRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class horarioUcMRepositoryTest extends TestCase
{
    use MakehorarioUcMTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var horarioUcMRepository
     */
    protected $horarioUcMRepo;

    public function setUp()
    {
        parent::setUp();
        $this->horarioUcMRepo = App::make(horarioUcMRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatehorarioUcM()
    {
        $horarioUcM = $this->fakehorarioUcMData();
        $createdhorarioUcM = $this->horarioUcMRepo->create($horarioUcM);
        $createdhorarioUcM = $createdhorarioUcM->toArray();
        $this->assertArrayHasKey('id', $createdhorarioUcM);
        $this->assertNotNull($createdhorarioUcM['id'], 'Created horarioUcM must have id specified');
        $this->assertNotNull(horarioUcM::find($createdhorarioUcM['id']), 'horarioUcM with given id must be in DB');
        $this->assertModelData($horarioUcM, $createdhorarioUcM);
    }

    /**
     * @test read
     */
    public function testReadhorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $dbhorarioUcM = $this->horarioUcMRepo->find($horarioUcM->id);
        $dbhorarioUcM = $dbhorarioUcM->toArray();
        $this->assertModelData($horarioUcM->toArray(), $dbhorarioUcM);
    }

    /**
     * @test update
     */
    public function testUpdatehorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $fakehorarioUcM = $this->fakehorarioUcMData();
        $updatedhorarioUcM = $this->horarioUcMRepo->update($fakehorarioUcM, $horarioUcM->id);
        $this->assertModelData($fakehorarioUcM, $updatedhorarioUcM->toArray());
        $dbhorarioUcM = $this->horarioUcMRepo->find($horarioUcM->id);
        $this->assertModelData($fakehorarioUcM, $dbhorarioUcM->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletehorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $resp = $this->horarioUcMRepo->delete($horarioUcM->id);
        $this->assertTrue($resp);
        $this->assertNull(horarioUcM::find($horarioUcM->id), 'horarioUcM should not exist in DB');
    }
}
