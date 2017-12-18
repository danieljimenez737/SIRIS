<?php

use Faker\Factory as Faker;
use App\Models\ruta;
use App\Repositories\rutaRepository;

trait MakerutaTrait
{
    /**
     * Create fake instance of ruta and save it in database
     *
     * @param array $rutaFields
     * @return ruta
     */
    public function makeruta($rutaFields = [])
    {
        /** @var rutaRepository $rutaRepo */
        $rutaRepo = App::make(rutaRepository::class);
        $theme = $this->fakerutaData($rutaFields);
        return $rutaRepo->create($theme);
    }

    /**
     * Get fake instance of ruta
     *
     * @param array $rutaFields
     * @return ruta
     */
    public function fakeruta($rutaFields = [])
    {
        return new ruta($this->fakerutaData($rutaFields));
    }

    /**
     * Get fake data of ruta
     *
     * @param array $postFields
     * @return array
     */
    public function fakerutaData($rutaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'latitud' => $fake->word,
            'longitud' => $fake->word,
            'cantidad_parada' => $fake->randomDigitNotNull,
            'cantidad_viaje' => $fake->randomDigitNotNull,
            'distancia' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $rutaFields);
    }
}
