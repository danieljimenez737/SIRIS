<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class horarioUcMApiTest extends TestCase
{
    use MakehorarioUcMTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatehorarioUcM()
    {
        $horarioUcM = $this->fakehorarioUcMData();
        $this->json('POST', '/api/v1/horarioUcMs', $horarioUcM);

        $this->assertApiResponse($horarioUcM);
    }

    /**
     * @test
     */
    public function testReadhorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $this->json('GET', '/api/v1/horarioUcMs/'.$horarioUcM->id);

        $this->assertApiResponse($horarioUcM->toArray());
    }

    /**
     * @test
     */
    public function testUpdatehorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $editedhorarioUcM = $this->fakehorarioUcMData();

        $this->json('PUT', '/api/v1/horarioUcMs/'.$horarioUcM->id, $editedhorarioUcM);

        $this->assertApiResponse($editedhorarioUcM);
    }

    /**
     * @test
     */
    public function testDeletehorarioUcM()
    {
        $horarioUcM = $this->makehorarioUcM();
        $this->json('DELETE', '/api/v1/horarioUcMs/'.$horarioUcM->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/horarioUcMs/'.$horarioUcM->id);

        $this->assertResponseStatus(404);
    }
}
