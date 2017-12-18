<?php

use App\Models\ruta;
use App\Repositories\rutaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class rutaRepositoryTest extends TestCase
{
    use MakerutaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var rutaRepository
     */
    protected $rutaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->rutaRepo = App::make(rutaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateruta()
    {
        $ruta = $this->fakerutaData();
        $createdruta = $this->rutaRepo->create($ruta);
        $createdruta = $createdruta->toArray();
        $this->assertArrayHasKey('id', $createdruta);
        $this->assertNotNull($createdruta['id'], 'Created ruta must have id specified');
        $this->assertNotNull(ruta::find($createdruta['id']), 'ruta with given id must be in DB');
        $this->assertModelData($ruta, $createdruta);
    }

    /**
     * @test read
     */
    public function testReadruta()
    {
        $ruta = $this->makeruta();
        $dbruta = $this->rutaRepo->find($ruta->id);
        $dbruta = $dbruta->toArray();
        $this->assertModelData($ruta->toArray(), $dbruta);
    }

    /**
     * @test update
     */
    public function testUpdateruta()
    {
        $ruta = $this->makeruta();
        $fakeruta = $this->fakerutaData();
        $updatedruta = $this->rutaRepo->update($fakeruta, $ruta->id);
        $this->assertModelData($fakeruta, $updatedruta->toArray());
        $dbruta = $this->rutaRepo->find($ruta->id);
        $this->assertModelData($fakeruta, $dbruta->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteruta()
    {
        $ruta = $this->makeruta();
        $resp = $this->rutaRepo->delete($ruta->id);
        $this->assertTrue($resp);
        $this->assertNull(ruta::find($ruta->id), 'ruta should not exist in DB');
    }
}
