<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class readHtmlApiTest extends TestCase
{
    use MakereadHtmlTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatereadHtml()
    {
        $readHtml = $this->fakereadHtmlData();
        $this->json('POST', '/api/v1/readHtmls', $readHtml);

        $this->assertApiResponse($readHtml);
    }

    /**
     * @test
     */
    public function testReadreadHtml()
    {
        $readHtml = $this->makereadHtml();
        $this->json('GET', '/api/v1/readHtmls/'.$readHtml->id);

        $this->assertApiResponse($readHtml->toArray());
    }

    /**
     * @test
     */
    public function testUpdatereadHtml()
    {
        $readHtml = $this->makereadHtml();
        $editedreadHtml = $this->fakereadHtmlData();

        $this->json('PUT', '/api/v1/readHtmls/'.$readHtml->id, $editedreadHtml);

        $this->assertApiResponse($editedreadHtml);
    }

    /**
     * @test
     */
    public function testDeletereadHtml()
    {
        $readHtml = $this->makereadHtml();
        $this->json('DELETE', '/api/v1/readHtmls/'.$readHtml->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/readHtmls/'.$readHtml->id);

        $this->assertResponseStatus(404);
    }
}
