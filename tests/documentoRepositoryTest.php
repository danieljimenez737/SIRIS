<?php

use App\Models\documento;
use App\Repositories\documentoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class documentoRepositoryTest extends TestCase
{
    use MakedocumentoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var documentoRepository
     */
    protected $documentoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->documentoRepo = App::make(documentoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatedocumento()
    {
        $documento = $this->fakedocumentoData();
        $createddocumento = $this->documentoRepo->create($documento);
        $createddocumento = $createddocumento->toArray();
        $this->assertArrayHasKey('id', $createddocumento);
        $this->assertNotNull($createddocumento['id'], 'Created documento must have id specified');
        $this->assertNotNull(documento::find($createddocumento['id']), 'documento with given id must be in DB');
        $this->assertModelData($documento, $createddocumento);
    }

    /**
     * @test read
     */
    public function testReaddocumento()
    {
        $documento = $this->makedocumento();
        $dbdocumento = $this->documentoRepo->find($documento->id);
        $dbdocumento = $dbdocumento->toArray();
        $this->assertModelData($documento->toArray(), $dbdocumento);
    }

    /**
     * @test update
     */
    public function testUpdatedocumento()
    {
        $documento = $this->makedocumento();
        $fakedocumento = $this->fakedocumentoData();
        $updateddocumento = $this->documentoRepo->update($fakedocumento, $documento->id);
        $this->assertModelData($fakedocumento, $updateddocumento->toArray());
        $dbdocumento = $this->documentoRepo->find($documento->id);
        $this->assertModelData($fakedocumento, $dbdocumento->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletedocumento()
    {
        $documento = $this->makedocumento();
        $resp = $this->documentoRepo->delete($documento->id);
        $this->assertTrue($resp);
        $this->assertNull(documento::find($documento->id), 'documento should not exist in DB');
    }
}
