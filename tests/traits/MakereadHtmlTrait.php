<?php

use Faker\Factory as Faker;
use App\Models\readHtml;
use App\Repositories\readHtmlRepository;

trait MakereadHtmlTrait
{
    /**
     * Create fake instance of readHtml and save it in database
     *
     * @param array $readHtmlFields
     * @return readHtml
     */
    public function makereadHtml($readHtmlFields = [])
    {
        /** @var readHtmlRepository $readHtmlRepo */
        $readHtmlRepo = App::make(readHtmlRepository::class);
        $theme = $this->fakereadHtmlData($readHtmlFields);
        return $readHtmlRepo->create($theme);
    }

    /**
     * Get fake instance of readHtml
     *
     * @param array $readHtmlFields
     * @return readHtml
     */
    public function fakereadHtml($readHtmlFields = [])
    {
        return new readHtml($this->fakereadHtmlData($readHtmlFields));
    }

    /**
     * Get fake data of readHtml
     *
     * @param array $postFields
     * @return array
     */
    public function fakereadHtmlData($readHtmlFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $readHtmlFields);
    }
}
