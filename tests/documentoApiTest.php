<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class documentoApiTest extends TestCase
{
    use MakedocumentoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatedocumento()
    {
        $documento = $this->fakedocumentoData();
        $this->json('POST', '/api/v1/documentos', $documento);

        $this->assertApiResponse($documento);
    }

    /**
     * @test
     */
    public function testReaddocumento()
    {
        $documento = $this->makedocumento();
        $this->json('GET', '/api/v1/documentos/'.$documento->id);

        $this->assertApiResponse($documento->toArray());
    }

    /**
     * @test
     */
    public function testUpdatedocumento()
    {
        $documento = $this->makedocumento();
        $editeddocumento = $this->fakedocumentoData();

        $this->json('PUT', '/api/v1/documentos/'.$documento->id, $editeddocumento);

        $this->assertApiResponse($editeddocumento);
    }

    /**
     * @test
     */
    public function testDeletedocumento()
    {
        $documento = $this->makedocumento();
        $this->json('DELETE', '/api/v1/documentos/'.$documento->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/documentos/'.$documento->id);

        $this->assertResponseStatus(404);
    }
}
