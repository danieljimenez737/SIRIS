<?php

use App\Models\terminos;
use App\Repositories\terminosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class terminosRepositoryTest extends TestCase
{
    use MaketerminosTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var terminosRepository
     */
    protected $terminosRepo;

    public function setUp()
    {
        parent::setUp();
        $this->terminosRepo = App::make(terminosRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateterminos()
    {
        $terminos = $this->faketerminosData();
        $createdterminos = $this->terminosRepo->create($terminos);
        $createdterminos = $createdterminos->toArray();
        $this->assertArrayHasKey('id', $createdterminos);
        $this->assertNotNull($createdterminos['id'], 'Created terminos must have id specified');
        $this->assertNotNull(terminos::find($createdterminos['id']), 'terminos with given id must be in DB');
        $this->assertModelData($terminos, $createdterminos);
    }

    /**
     * @test read
     */
    public function testReadterminos()
    {
        $terminos = $this->maketerminos();
        $dbterminos = $this->terminosRepo->find($terminos->id);
        $dbterminos = $dbterminos->toArray();
        $this->assertModelData($terminos->toArray(), $dbterminos);
    }

    /**
     * @test update
     */
    public function testUpdateterminos()
    {
        $terminos = $this->maketerminos();
        $faketerminos = $this->faketerminosData();
        $updatedterminos = $this->terminosRepo->update($faketerminos, $terminos->id);
        $this->assertModelData($faketerminos, $updatedterminos->toArray());
        $dbterminos = $this->terminosRepo->find($terminos->id);
        $this->assertModelData($faketerminos, $dbterminos->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteterminos()
    {
        $terminos = $this->maketerminos();
        $resp = $this->terminosRepo->delete($terminos->id);
        $this->assertTrue($resp);
        $this->assertNull(terminos::find($terminos->id), 'terminos should not exist in DB');
    }
}
