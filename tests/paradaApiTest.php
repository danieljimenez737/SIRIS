<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class paradaApiTest extends TestCase
{
    use MakeparadaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateparada()
    {
        $parada = $this->fakeparadaData();
        $this->json('POST', '/api/v1/paradas', $parada);

        $this->assertApiResponse($parada);
    }

    /**
     * @test
     */
    public function testReadparada()
    {
        $parada = $this->makeparada();
        $this->json('GET', '/api/v1/paradas/'.$parada->id);

        $this->assertApiResponse($parada->toArray());
    }

    /**
     * @test
     */
    public function testUpdateparada()
    {
        $parada = $this->makeparada();
        $editedparada = $this->fakeparadaData();

        $this->json('PUT', '/api/v1/paradas/'.$parada->id, $editedparada);

        $this->assertApiResponse($editedparada);
    }

    /**
     * @test
     */
    public function testDeleteparada()
    {
        $parada = $this->makeparada();
        $this->json('DELETE', '/api/v1/paradas/'.$parada->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/paradas/'.$parada->id);

        $this->assertResponseStatus(404);
    }
}
