<?php

use App\Models\readHtml;
use App\Repositories\readHtmlRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class readHtmlRepositoryTest extends TestCase
{
    use MakereadHtmlTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var readHtmlRepository
     */
    protected $readHtmlRepo;

    public function setUp()
    {
        parent::setUp();
        $this->readHtmlRepo = App::make(readHtmlRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatereadHtml()
    {
        $readHtml = $this->fakereadHtmlData();
        $createdreadHtml = $this->readHtmlRepo->create($readHtml);
        $createdreadHtml = $createdreadHtml->toArray();
        $this->assertArrayHasKey('id', $createdreadHtml);
        $this->assertNotNull($createdreadHtml['id'], 'Created readHtml must have id specified');
        $this->assertNotNull(readHtml::find($createdreadHtml['id']), 'readHtml with given id must be in DB');
        $this->assertModelData($readHtml, $createdreadHtml);
    }

    /**
     * @test read
     */
    public function testReadreadHtml()
    {
        $readHtml = $this->makereadHtml();
        $dbreadHtml = $this->readHtmlRepo->find($readHtml->id);
        $dbreadHtml = $dbreadHtml->toArray();
        $this->assertModelData($readHtml->toArray(), $dbreadHtml);
    }

    /**
     * @test update
     */
    public function testUpdatereadHtml()
    {
        $readHtml = $this->makereadHtml();
        $fakereadHtml = $this->fakereadHtmlData();
        $updatedreadHtml = $this->readHtmlRepo->update($fakereadHtml, $readHtml->id);
        $this->assertModelData($fakereadHtml, $updatedreadHtml->toArray());
        $dbreadHtml = $this->readHtmlRepo->find($readHtml->id);
        $this->assertModelData($fakereadHtml, $dbreadHtml->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletereadHtml()
    {
        $readHtml = $this->makereadHtml();
        $resp = $this->readHtmlRepo->delete($readHtml->id);
        $this->assertTrue($resp);
        $this->assertNull(readHtml::find($readHtml->id), 'readHtml should not exist in DB');
    }
}
