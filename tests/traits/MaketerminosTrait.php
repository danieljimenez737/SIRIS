<?php

use Faker\Factory as Faker;
use App\Models\terminos;
use App\Repositories\terminosRepository;

trait MaketerminosTrait
{
    /**
     * Create fake instance of terminos and save it in database
     *
     * @param array $terminosFields
     * @return terminos
     */
    public function maketerminos($terminosFields = [])
    {
        /** @var terminosRepository $terminosRepo */
        $terminosRepo = App::make(terminosRepository::class);
        $theme = $this->faketerminosData($terminosFields);
        return $terminosRepo->create($theme);
    }

    /**
     * Get fake instance of terminos
     *
     * @param array $terminosFields
     * @return terminos
     */
    public function faketerminos($terminosFields = [])
    {
        return new terminos($this->faketerminosData($terminosFields));
    }

    /**
     * Get fake data of terminos
     *
     * @param array $postFields
     * @return array
     */
    public function faketerminosData($terminosFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $terminosFields);
    }
}
