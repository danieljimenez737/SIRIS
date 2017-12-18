<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class horarioMUcApiTest extends TestCase
{
    use MakehorarioMUcTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatehorarioMUc()
    {
        $horarioMUc = $this->fakehorarioMUcData();
        $this->json('POST', '/api/v1/horarioMUcs', $horarioMUc);

        $this->assertApiResponse($horarioMUc);
    }

    /**
     * @test
     */
    public function testReadhorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $this->json('GET', '/api/v1/horarioMUcs/'.$horarioMUc->id);

        $this->assertApiResponse($horarioMUc->toArray());
    }

    /**
     * @test
     */
    public function testUpdatehorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $editedhorarioMUc = $this->fakehorarioMUcData();

        $this->json('PUT', '/api/v1/horarioMUcs/'.$horarioMUc->id, $editedhorarioMUc);

        $this->assertApiResponse($editedhorarioMUc);
    }

    /**
     * @test
     */
    public function testDeletehorarioMUc()
    {
        $horarioMUc = $this->makehorarioMUc();
        $this->json('DELETE', '/api/v1/horarioMUcs/'.$horarioMUc->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/horarioMUcs/'.$horarioMUc->id);

        $this->assertResponseStatus(404);
    }
}
