<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ubicacionApiTest extends TestCase
{
    use MakeubicacionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateubicacion()
    {
        $ubicacion = $this->fakeubicacionData();
        $this->json('POST', '/api/v1/ubicacions', $ubicacion);

        $this->assertApiResponse($ubicacion);
    }

    /**
     * @test
     */
    public function testReadubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $this->json('GET', '/api/v1/ubicacions/'.$ubicacion->id);

        $this->assertApiResponse($ubicacion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $editedubicacion = $this->fakeubicacionData();

        $this->json('PUT', '/api/v1/ubicacions/'.$ubicacion->id, $editedubicacion);

        $this->assertApiResponse($editedubicacion);
    }

    /**
     * @test
     */
    public function testDeleteubicacion()
    {
        $ubicacion = $this->makeubicacion();
        $this->json('DELETE', '/api/v1/ubicacions/'.$ubicacion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/ubicacions/'.$ubicacion->id);

        $this->assertResponseStatus(404);
    }
}
