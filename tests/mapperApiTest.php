<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class mapperApiTest extends TestCase
{
    use MakemapperTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatemapper()
    {
        $mapper = $this->fakemapperData();
        $this->json('POST', '/api/v1/mappers', $mapper);

        $this->assertApiResponse($mapper);
    }

    /**
     * @test
     */
    public function testReadmapper()
    {
        $mapper = $this->makemapper();
        $this->json('GET', '/api/v1/mappers/'.$mapper->id);

        $this->assertApiResponse($mapper->toArray());
    }

    /**
     * @test
     */
    public function testUpdatemapper()
    {
        $mapper = $this->makemapper();
        $editedmapper = $this->fakemapperData();

        $this->json('PUT', '/api/v1/mappers/'.$mapper->id, $editedmapper);

        $this->assertApiResponse($editedmapper);
    }

    /**
     * @test
     */
    public function testDeletemapper()
    {
        $mapper = $this->makemapper();
        $this->json('DELETE', '/api/v1/mappers/'.$mapper->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/mappers/'.$mapper->id);

        $this->assertResponseStatus(404);
    }
}
