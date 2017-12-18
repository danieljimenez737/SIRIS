<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class terminosApiTest extends TestCase
{
    use MaketerminosTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateterminos()
    {
        $terminos = $this->faketerminosData();
        $this->json('POST', '/api/v1/terminos', $terminos);

        $this->assertApiResponse($terminos);
    }

    /**
     * @test
     */
    public function testReadterminos()
    {
        $terminos = $this->maketerminos();
        $this->json('GET', '/api/v1/terminos/'.$terminos->id);

        $this->assertApiResponse($terminos->toArray());
    }

    /**
     * @test
     */
    public function testUpdateterminos()
    {
        $terminos = $this->maketerminos();
        $editedterminos = $this->faketerminosData();

        $this->json('PUT', '/api/v1/terminos/'.$terminos->id, $editedterminos);

        $this->assertApiResponse($editedterminos);
    }

    /**
     * @test
     */
    public function testDeleteterminos()
    {
        $terminos = $this->maketerminos();
        $this->json('DELETE', '/api/v1/terminos/'.$terminos->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/terminos/'.$terminos->id);

        $this->assertResponseStatus(404);
    }
}
