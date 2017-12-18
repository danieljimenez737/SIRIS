<?php

use Faker\Factory as Faker;
use App\Models\paradasUc;
use App\Repositories\paradasUcRepository;

trait MakeparadasUcTrait
{
    /**
     * Create fake instance of paradasUc and save it in database
     *
     * @param array $paradasUcFields
     * @return paradasUc
     */
    public function makeparadasUc($paradasUcFields = [])
    {
        /** @var paradasUcRepository $paradasUcRepo */
        $paradasUcRepo = App::make(paradasUcRepository::class);
        $theme = $this->fakeparadasUcData($paradasUcFields);
        return $paradasUcRepo->create($theme);
    }

    /**
     * Get fake instance of paradasUc
     *
     * @param array $paradasUcFields
     * @return paradasUc
     */
    public function fakeparadasUc($paradasUcFields = [])
    {
        return new paradasUc($this->fakeparadasUcData($paradasUcFields));
    }

    /**
     * Get fake data of paradasUc
     *
     * @param array $postFields
     * @return array
     */
    public function fakeparadasUcData($paradasUcFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'latitud' => $fake->word,
            'longitud' => $fake->word,
            'descripcion' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $paradasUcFields);
    }
}
