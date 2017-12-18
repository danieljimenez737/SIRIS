<?php

use App\Models\ubicacion;
use App\Repositories\ubicacionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ubicacionRepositoryTest extends TestCase
{
    use MakeubicacionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ubicacionRepository
     */
    protected $ubicacionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->ubicacionRepo = App::make(ubicacionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateubicacion()
    {
        $ubicacion = $this->fakeubicacionData();
        $createdubicacion = $this->ubicacionRepo->create($ubicacion);
        $createdubicacion = $createdubicacion->toArray();
        $this->assertArrayHasKey('id', $createdubicacion);
        $this->assertNotNull($createdubicacion['id'], 'Created ubicacion must have id specified');
        $this->assertNotNull(ubicacion::find($createdubicacion['id']), 'ubicacion with given id must be in DB');
        $this->assertModelData($ubicacion, $createdubicacion);
    }

    /**
     * @test read
     */
    public function testReadubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $dbubicacion = $this->ubicacionRepo->find($ubicacion->id);
        $dbubicacion = $dbubicacion->toArray();
        $this->assertModelData($ubicacion->toArray(), $dbubicacion);
    }

    /**
     * @test update
     */
    public function testUpdateubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $fakeubicacion = $this->fakeubicacionData();
        $updatedubicacion = $this->ubicacionRepo->update($fakeubicacion, $ubicacion->id);
        $this->assertModelData($fakeubicacion, $updatedubicacion->toArray());
        $dbubicacion = $this->ubicacionRepo->find($ubicacion->id);
        $this->assertModelData($fakeubicacion, $dbubicacion->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $resp = $this->ubicacionRepo->delete($ubicacion->id);
        $this->assertTrue($resp);
        $this->assertNull(ubicacion::find($ubicacion->id), 'ubicacion should not exist in DB');
    }
}
