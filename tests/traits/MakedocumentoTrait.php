<?php

use Faker\Factory as Faker;
use App\Models\documento;
use App\Repositories\documentoRepository;

trait MakedocumentoTrait
{
    /**
     * Create fake instance of documento and save it in database
     *
     * @param array $documentoFields
     * @return documento
     */
    public function makedocumento($documentoFields = [])
    {
        /** @var documentoRepository $documentoRepo */
        $documentoRepo = App::make(documentoRepository::class);
        $theme = $this->fakedocumentoData($documentoFields);
        return $documentoRepo->create($theme);
    }

    /**
     * Get fake instance of documento
     *
     * @param array $documentoFields
     * @return documento
     */
    public function fakedocumento($documentoFields = [])
    {
        return new documento($this->fakedocumentoData($documentoFields));
    }

    /**
     * Get fake data of documento
     *
     * @param array $postFields
     * @return array
     */
    public function fakedocumentoData($documentoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'titulo' => $fake->word,
            'link' => $fake->word,
            'fecha' => $fake->word,
            'ubicacion' => $fake->word,
            'contenido' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $documentoFields);
    }
}
