<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class rutaApiTest extends TestCase
{
    use MakerutaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateruta()
    {
        $ruta = $this->fakerutaData();
        $this->json('POST', '/api/v1/rutas', $ruta);

        $this->assertApiResponse($ruta);
    }

    /**
     * @test
     */
    public function testReadruta()
    {
        $ruta = $this->makeruta();
        $this->json('GET', '/api/v1/rutas/'.$ruta->id);

        $this->assertApiResponse($ruta->toArray());
    }

    /**
     * @test
     */
    public function testUpdateruta()
    {
        $ruta = $this->makeruta();
        $editedruta = $this->fakerutaData();

        $this->json('PUT', '/api/v1/rutas/'.$ruta->id, $editedruta);

        $this->assertApiResponse($editedruta);
    }

    /**
     * @test
     */
    public function testDeleteruta()
    {
        $ruta = $this->makeruta();
        $this->json('DELETE', '/api/v1/rutas/'.$ruta->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/rutas/'.$ruta->id);

        $this->assertResponseStatus(404);
    }
}
