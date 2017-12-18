<?php

use Faker\Factory as Faker;
use App\Models\ubicacion;
use App\Repositories\ubicacionRepository;

trait MakeubicacionTrait
{
    /**
     * Create fake instance of ubicacion and save it in database
     *
     * @param array $ubicacionFields
     * @return ubicacion
     */
    public function makeubicacion($ubicacionFields = [])
    {
        /** @var ubicacionRepository $ubicacionRepo */
        $ubicacionRepo = App::make(ubicacionRepository::class);
        $theme = $this->fakeubicacionData($ubicacionFields);
        return $ubicacionRepo->create($theme);
    }

    /**
     * Get fake instance of ubicacion
     *
     * @param array $ubicacionFields
     * @return ubicacion
     */
    public function fakeubicacion($ubicacionFields = [])
    {
        return new ubicacion($this->fakeubicacionData($ubicacionFields));
    }

    /**
     * Get fake data of ubicacion
     *
     * @param array $postFields
     * @return array
     */
    public function fakeubicacionData($ubicacionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'ubicacion' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $ubicacionFields);
    }
}
