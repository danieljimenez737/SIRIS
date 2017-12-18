<?php

use Faker\Factory as Faker;
use App\Models\horarioUcM;
use App\Repositories\horarioUcMRepository;

trait MakehorarioUcMTrait
{
    /**
     * Create fake instance of horarioUcM and save it in database
     *
     * @param array $horarioUcMFields
     * @return horarioUcM
     */
    public function makehorarioUcM($horarioUcMFields = [])
    {
        /** @var horarioUcMRepository $horarioUcMRepo */
        $horarioUcMRepo = App::make(horarioUcMRepository::class);
        $theme = $this->fakehorarioUcMData($horarioUcMFields);
        return $horarioUcMRepo->create($theme);
    }

    /**
     * Get fake instance of horarioUcM
     *
     * @param array $horarioUcMFields
     * @return horarioUcM
     */
    public function fakehorarioUcM($horarioUcMFields = [])
    {
        return new horarioUcM($this->fakehorarioUcMData($horarioUcMFields));
    }

    /**
     * Get fake data of horarioUcM
     *
     * @param array $postFields
     * @return array
     */
    public function fakehorarioUcMData($horarioUcMFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'idRuta' => $fake->randomDigitNotNull,
            'horas' => $fake->word,
            'bus' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $horarioUcMFields);
    }
}
