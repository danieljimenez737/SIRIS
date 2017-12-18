<?php

use App\Models\parada;
use App\Repositories\paradaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class paradaRepositoryTest extends TestCase
{
    use MakeparadaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var paradaRepository
     */
    protected $paradaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->paradaRepo = App::make(paradaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateparada()
    {
        $parada = $this->fakeparadaData();
        $createdparada = $this->paradaRepo->create($parada);
        $createdparada = $createdparada->toArray();
        $this->assertArrayHasKey('id', $createdparada);
        $this->assertNotNull($createdparada['id'], 'Created parada must have id specified');
        $this->assertNotNull(parada::find($createdparada['id']), 'parada with given id must be in DB');
        $this->assertModelData($parada, $createdparada);
    }

    /**
     * @test read
     */
    public function testReadparada()
    {
        $parada = $this->makeparada();
        $dbparada = $this->paradaRepo->find($parada->id);
        $dbparada = $dbparada->toArray();
        $this->assertModelData($parada->toArray(), $dbparada);
    }

    /**
     * @test update
     */
    public function testUpdateparada()
    {
        $parada = $this->makeparada();
        $fakeparada = $this->fakeparadaData();
        $updatedparada = $this->paradaRepo->update($fakeparada, $parada->id);
        $this->assertModelData($fakeparada, $updatedparada->toArray());
        $dbparada = $this->paradaRepo->find($parada->id);
        $this->assertModelData($fakeparada, $dbparada->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteparada()
    {
        $parada = $this->makeparada();
        $resp = $this->paradaRepo->delete($parada->id);
        $this->assertTrue($resp);
        $this->assertNull(parada::find($parada->id), 'parada should not exist in DB');
    }
}
