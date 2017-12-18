<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class paradasUcApiTest extends TestCase
{
    use MakeparadasUcTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateparadasUc()
    {
        $paradasUc = $this->fakeparadasUcData();
        $this->json('POST', '/api/v1/paradasUcs', $paradasUc);

        $this->assertApiResponse($paradasUc);
    }

    /**
     * @test
     */
    public function testReadparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $this->json('GET', '/api/v1/paradasUcs/'.$paradasUc->id);

        $this->assertApiResponse($paradasUc->toArray());
    }

    /**
     * @test
     */
    public function testUpdateparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $editedparadasUc = $this->fakeparadasUcData();

        $this->json('PUT', '/api/v1/paradasUcs/'.$paradasUc->id, $editedparadasUc);

        $this->assertApiResponse($editedparadasUc);
    }

    /**
     * @test
     */
    public function testDeleteparadasUc()
    {
        $paradasUc = $this->makeparadasUc();
        $this->json('DELETE', '/api/v1/paradasUcs/'.$paradasUc->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/paradasUcs/'.$paradasUc->id);

        $this->assertResponseStatus(404);
    }
}
