<?php

use Faker\Factory as Faker;
use App\Models\parada;
use App\Repositories\paradaRepository;

trait MakeparadaTrait
{
    /**
     * Create fake instance of parada and save it in database
     *
     * @param array $paradaFields
     * @return parada
     */
    public function makeparada($paradaFields = [])
    {
        /** @var paradaRepository $paradaRepo */
        $paradaRepo = App::make(paradaRepository::class);
        $theme = $this->fakeparadaData($paradaFields);
        return $paradaRepo->create($theme);
    }

    /**
     * Get fake instance of parada
     *
     * @param array $paradaFields
     * @return parada
     */
    public function fakeparada($paradaFields = [])
    {
        return new parada($this->fakeparadaData($paradaFields));
    }

    /**
     * Get fake data of parada
     *
     * @param array $postFields
     * @return array
     */
    public function fakeparadaData($paradaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'idRuta' => $fake->randomDigitNotNull,
            'nombre' => $fake->word,
            'descripcion' => $fake->word,
            'latitud' => $fake->word,
            'longitud' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $paradaFields);
    }
}
