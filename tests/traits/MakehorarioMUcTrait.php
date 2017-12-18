<?php

use Faker\Factory as Faker;
use App\Models\horarioMUc;
use App\Repositories\horarioMUcRepository;

trait MakehorarioMUcTrait
{
    /**
     * Create fake instance of horarioMUc and save it in database
     *
     * @param array $horarioMUcFields
     * @return horarioMUc
     */
    public function makehorarioMUc($horarioMUcFields = [])
    {
        /** @var horarioMUcRepository $horarioMUcRepo */
        $horarioMUcRepo = App::make(horarioMUcRepository::class);
        $theme = $this->fakehorarioMUcData($horarioMUcFields);
        return $horarioMUcRepo->create($theme);
    }

    /**
     * Get fake instance of horarioMUc
     *
     * @param array $horarioMUcFields
     * @return horarioMUc
     */
    public function fakehorarioMUc($horarioMUcFields = [])
    {
        return new horarioMUc($this->fakehorarioMUcData($horarioMUcFields));
    }

    /**
     * Get fake data of horarioMUc
     *
     * @param array $postFields
     * @return array
     */
    public function fakehorarioMUcData($horarioMUcFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'idRuta' => $fake->randomDigitNotNull,
            'horas' => $fake->word,
            'bus' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $horarioMUcFields);
    }
}
