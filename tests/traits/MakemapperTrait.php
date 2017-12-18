<?php

use Faker\Factory as Faker;
use App\Models\mapper;
use App\Repositories\mapperRepository;

trait MakemapperTrait
{
    /**
     * Create fake instance of mapper and save it in database
     *
     * @param array $mapperFields
     * @return mapper
     */
    public function makemapper($mapperFields = [])
    {
        /** @var mapperRepository $mapperRepo */
        $mapperRepo = App::make(mapperRepository::class);
        $theme = $this->fakemapperData($mapperFields);
        return $mapperRepo->create($theme);
    }

    /**
     * Get fake instance of mapper
     *
     * @param array $mapperFields
     * @return mapper
     */
    public function fakemapper($mapperFields = [])
    {
        return new mapper($this->fakemapperData($mapperFields));
    }

    /**
     * Get fake data of mapper
     *
     * @param array $postFields
     * @return array
     */
    public function fakemapperData($mapperFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mapperFields);
    }
}
