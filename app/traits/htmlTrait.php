<?php
namespace App\traits;
use Illuminate\Support\Facades\Log;
use Htmldom;
trait htmlTrait {
    protected $html;
    public function __construct()
    {
        parent::__construct();
        $this->html= new Htmldom();
    }
    
     public static function example(){
         Log::info("Demonio ejecuantose desde trait");
         
    }
    
     /*Funcion Principal llamada por el Daemon*/
    public static  function start(){  
         Log::info($this->html);
       //NOTICIAS SECUESTROS EL UNIVERSAL
      /*$link='http://www.eluniversal.com/localizador/secuestros';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=1;
        self::AnalizarHTML($link,$web,$getDate);*/
      /* //NOTICIAS ASESINATOS EL UNIVERSAL
      $link='http://www.eluniversal.com/localizador/asesinatos';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS HOMICIDIOS EL UNIVERSAL
        $link='http://www.eluniversal.com/localizador/homicidio';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS ROBOS EL UNIVERSAL
        $link='http://www.eluniversal.com/localizador/robos';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS SUCESOS EL NACIONAL
        $link='http://www.el-nacional.com/sucesos/';
        $web='http://www.el-nacional.com/noticias/sucesos/';
        $getDate=2;
        $this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS SUCESOS ULTIMAS NOTICIAS
       $link='http://www.ultimasnoticias.com.ve/seccion/sucesos/';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=3;
        $this->AnalizarHTML($link,$web,$getDate);    
        //NOTICIAS sucesos el noticiero de televen
        $link='http://www.televen.com/el-noticiero/nacionales/sucesos/';
        $web='http://www.televen.com/elnoticiero/';
        $getDate=4;
        $this->AnalizarHTML($link,$web,$getDate);
        */
        
         //NOTICIAS sucesos Cronica uno
    /*    $link='http://cronica.uno/category/sucesos/';
        $web='http://cronica.uno/category/sucesos/';
        $getDate=5;
        $this->AnalizarHTML($link,$web,$getDate);*/
        
        //NOTICIAS NACIONALES DEL NOTICIERO VENEVISION HAY QUE HACER VECTOR DE SUCESOS PARA FILTRAR
        //http://www.noticierovenevision.net/noticias/nacional/
        //LLAMAR A LA FUNCION QUE FILTRA EL TIPO DE SUCESO
        
        //$link='http://www.noticierovenevision.net/noticias/nacional/';
        
        //$web='http://www.televen.com/elnoticiero/';
        //$getDate=5;
        //$this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS SUCESOS DEL NOTICIERO GLOBOVISION
       /* $link='http://www.globovision.com/sucesos';
        $web='article';
        $getDate=6;
        $this->AnalizarHTML($link,$web,$getDate);
        $this->twitter('@DiariodeCaracas');
        $this->twitter('@ElNacionalWeb');
        $this->twitter('@Diario_ElTiempo');
        $this->twitter('@webnotitarde');
        $this->twitter('@eldiariolavoz');
        $this->twitter('@diariopanorama');
        $this->twitter('@laverdadweb');*/
    }
    //PROCESAMIENTO DE HTML
    public static function AnalizarHTML($url='http://www.eluniversal.com/localizador/secuestros',$web,$getDate){
        //$stemmer = new Spanish(); para 
        
        $html = new \Htmldom($url);
       Log::info($html);
        // muestra todo los parrafos 
        ///foreach($html->find('article') as $element) 
        //extrayendo los links de sucesos 
      
        foreach($html->find('a') as $element) {
        //compara si el substring existe en el link        
            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
            
            $pos = strpos($element-> href, $web);
            
            if($pos!==false){
                
                //busca la ubicacion del suceso
                echo 'LINKs --> '.$element->href.'<br>';
                //se guarda el link y el doc en la BD
              
                $html2 = new \Htmldom($element->href);
                //extrayendo la fecha y titulo de la noticia del eluniversal
                if($getDate==1){
                   
                    $this->getNotice("p[class=clearfix]",'h2[class=title]', $html2,'div[class=note-text] p',$element->href);
                }else{
                //extrayendo la fecha y titulo de la noticia del nacional
                    if($getDate==2){
                           $this->getNotice("time[class=date]",'header[class=detail-header] h1', $html2,'div[class=detail-body] p',$element->href);
                    }else{
                        //extrayendo la fecha y titulo de la noticia del ultimasnoticias
                        if($getDate==3){
                              $this->getNotice("span[class=entry-meta] span",'h1[class=entry-title h1]', $html2,'div[class=entry-content herald-entry-content] p',$element->href);
                        }else{
                            //extrayendo la fecha y titulo de la noticia del noticiero de televen
                            if($getDate==4){
                                $this->getNotice("div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 fechaHora]" ,"div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo] <h1>", $html2,'div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 contenido] p',$element->href);
                            }else{
                               if($getDate==5){
                                  
                                $this->getNotice("time[class=xt-post-date]" ,"div[class=featured-image-behind-title-wrap gradient-wrap]", $html2,'div[class=post-body  xt-post-content]  p',$element->href);                               
                               }else{
                                   if($getDate==6){
                                        $html2 = new \Htmldom('http://globovision.com'.$element->href);
                                        //globovvision
                                        $this->getNotice("time[class=date]" ,"h1[class=article-title]", $html2,'div[class=article-body] div p',$element->href);
                                     }else{
                                   if($getDate==7){
                                        $this->getNotice("time[class=date]" ,"h1[class=article-title]", $html2,'div[class=article-body] div p',$element->href);
                                    }
                                     }
                                }
                            }
                        }
                    }
                }
                 
            }
        } 
    }
        /*Funcion para leer la noticia y extraer sus datos*/
    public function getNotice($Str_fecha, $Str_tittle, $html2, $Str_parrafo,$link){
        //Vector de ubicaciones 
        //vector con las posibles ubicacions de los sucesos
        $ubicacion= $this->ubicaciones();
        $fecha_notic = $html2->find($Str_fecha,0)->plaintext;
        
      
        $tittle_notice=$html2->find($Str_tittle,0)->plaintext;
        $articulo='';
        $i=0;
        $encuentraUbic=false;
        while ($i<sizeof($ubicacion) && $encuentraUbic==false){
            //extrayendo el parrafo del link de la noticia
            //verificando que cumpla con la ubicacion
            if(strpos(strtolower ($tittle_notice), $ubicacion[$i]) !== false){
                echo 'LINK REVISANDO --> '.$link.'<br>';
                $encuentraUbic=true;
                 foreach($html2->find($Str_parrafo) as $element2){
                    //concatenando los parrafos del html
                    $articulo=$articulo.$element2;
                }
                //eliminando las etiquetas del parrafo
                $articulo_normalizado=strip_tags(html_entity_decode($articulo, ENT_HTML5, 'UTF-8'));
                $articulo_normalizado=($this->limpiar_caracteres_esp($articulo_normalizado));
                //plain texto sin caracterers especiales
                 echo $fecha_notic.'---'.$tittle_notice.'---<br>'.$articulo_normalizado.'<br>';
                //verificando que no exista ese titulo en la BD para no guardarlo en la BD
                $consultaTitulo=DB::table('documento')->where('titulo',$tittle_notice)->get();
                //Guardando en la BD
                if(sizeof($consultaTitulo)<1){
                    DB::table('documento')->insert(
                    ['titulo' => $tittle_notice, 
                    'link' => $link,
                    'ubicacion'=>$ubicacion[$i],
                    'fecha'=> $fecha_notic,
                    'contenido'=> $articulo_normalizado
                    ]);
                }
            }
        $i++;   
        }
    }
    public function ubicaciones(){
         $ubicacion= array ("altagracia","antímano","caricuao","catedral","Coche","junquito",
          "paraiso","recreo","valle","candelaria","pastora","vega","macarao","catia",
          "sanagustín","sanbernardino","sanjose","sanjuan","sanpedro", 'carlota',
          "santarosalia","santateresa","23 de enero",'macarao','caracas',
          'Aragüita', 'Arévalo González','Capaya','Caucagua','Panaquire','Ribas','El Café','Marizapa','Cumbo','San José de Barlovento','El Cafetal','Las Minas',
 'Nuestra Señora del Rosario', 'Higuerote', 'Curiepe', 'Tacarigua de Brión', 'Mamporal', 'Carrizal', 'Chacao', 'Charallave', 'Las Brisas',
 'El Hatillo', 'Altagracia de la Montaña', 'Cecilio Acosta', 'Los Teques', 'El Jarillo', 'San Pedro', 'Tácata', 'Paracotos', 'Cartanal',
 'Santa Teresa del Tuy', 'La Democracia', 'Ocumare del Tuy', 'Santa Bárbara', 'San Antonio de los Altos', 'Río Chico', 'El Guapo',
 'Tacarigua de la Laguna', 'Paparo', 'San Fernando del Guapo', 'Santa Lucía del Tuy', 'Cúpira', 'Machurucuto', 'Guarenas',
 'San Antonio de Yare', 'San Francisco de Yare', 'Leoncio Martínez', 'Petare', 'Caucagüita', 'Filas de Mariche', 'La Dolorita',
 'Cúa','Nueva Cúa', 'Guatire', 'Bolívar');

    return $ubicacion;
    }
}