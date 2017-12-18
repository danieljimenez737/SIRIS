<?php

use Illuminate\Database\Seeder;
use Wamania\Snowball\Spanish;
use Illuminate\Support\Facades\Log;
class terminos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $termino = array ("robo","hurto","secuestraron",
          "asesinada","secuestro","mato","asesinan","asesinatos",
          "violan","feminicidio","apuñalaron","puñaladas",
          "degollaron","descuartizo","desmiembran","desmenbraron", "infanticidio");
          
          
          for($i=0;$i<sizeof($termino);$i++){
            $stemmer = new Spanish();
            //Log::info($stemmer->stem($termino[$i])); 
              DB::table('termino')->insert([
            'nombre' => $stemmer->stem($termino[$i]),
           // 'created_at' => date("Y/m/d") . '-' . date("h:i:sa"),
        ]);
          }
        
    }
}
