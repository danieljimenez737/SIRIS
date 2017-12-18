<?php

use Illuminate\Database\Seeder;

class ubicacion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $ubicacion= array ("Altagracia","Antimano","Caricuao","Catedral","Coche","junquito",
          "El Paraiso","El Recreo","El Valle","La Candelaria","la Pastora","La Vega","Macarao","Catia",
          "San Agustín","sanbernardino","sanjose","sanjuan","sanpedro", 'carlota','Sabana Grande',
          "Santa Rosalia","Santa Teresa","23 de Enero",'Macarao','Caracas',
          'Aragüita', 'Arévalo González','Capaya','Caucagua','Panaquire','Ribas','El Café','Marizapa','Cumbo','San José de Barlovento','El Cafetal','Las Minas',
 'Nuestra Señora del Rosario', 'Higuerote', 'Curiepe', 'Tacarigua de Brión', 'Mamporal', 'Carrizal', 'Chacao', 'Charallave', 'Las Brisas',
 'El Hatillo', 'Altagracia de la Montaña', 'Cecilio Acosta', 'Los Teques', 'El Jarillo', 'San Pedro', 'Tacata', 'Paracotos', 'Cartanal',
 'Santa Teresa del Tuy', 'La Democracia', 'Ocumare del Tuy', 'Santa Bárbara', 'San Antonio de los Altos', 'Río Chico', 'El Guapo',
 'Tacarigua de la Laguna', 'Paparo', 'San Fernando del Guapo', 'Santa Lucía del Tuy', 'Cupira', 'Machurucuto', 'Guarenas', 'Guatire',
 'San Antonio de Yare', 'San Francisco de Yare', 'Leoncio Martínez', 'Petare', 'Caucagüita', 'Filas de Mariche', 'La Dolorita',
 'Cúa','Nueva Cúa', 'Guatire', 'Bolívar', 'trinidad','ciudad bolivar','maiquetia','carabobo','aragua','vargas');
       for($i=0;$i<sizeof($ubicacion);$i++){
            
            //Log::info($stemmer->stem($termino[$i])); 
              DB::table('ubicacion')->insert([
            'ubicacion' => $ubicacion[$i]
           // 'created_at' => date("Y/m/d") . '-' . date("h:i:sa"),
        ]);
          }
    }
}
