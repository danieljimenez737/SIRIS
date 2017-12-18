<?php

namespace App\Http\Controllers;
use Wamania\Snowball\Spanish;

use Illuminate\Http\Request;

class readHtml extends Controller
{
    //
    
    public function start(){
        //http://www.eluniversal.com/sucesos/
        //$getDate=1;
        //http://www.el-nacional.com/sucesos/
          //$getDate=2;
        //http://www.ultimasnoticias.com.ve/seccion/sucesos/
        // $getDate=3;
        //http://www.caraotadigital.net/category/sucesos/
         //$getDate=4;
        $link='http://www.caraotadigital.net/category/sucesos/';
       // $web='http://www.ultimasnoticias.com.ve/noticias/sucesos';
       // $web='http://www.caraotadigital.net/sucesos/';
        $web='http://www.caraotadigital.net/sucesos/';
        
        $getDate=4;
        $this->AnalizarHTML($link,$web,$getDate);
        
    }
     public function AnalizarHTML($url,$web,$getDate){
         
         $stemmer = new Spanish();

    
        $html = new \Htmldom($url);
        //vector con las posibles ubicacions de los sucesos
        $ubicacion= array ("altagracia","antímano","caricuao","catedral","Coche","junquito",
          "paraiso","recreo","valle","candelaria","pastora","vega","macarao","catia",
          "sanagustín","sanbernardino","sanjose","sanjuan","sanpedro","santarosalia",
          "santateresa","23deenero",'macarao','caracas','contrabando');
        // muestra todo los parrafos 
        ///foreach($html->find('article') as $element) 
    
        //extrayendo los links de sucesos 
        foreach($html->find('a') as $element) {
            
       //compara si el substring existe en el link        
            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
              $pos = strpos($element-> href, $web);
         
              if($pos!==false){
                 //busca la ubicacion del suceso
                 $i=0;
                 $encuentra_ubic=true;
                 
                 while($encuentra_ubic && $i<sizeof($ubicacion)){
                  
                    if(strpos($element->href, $ubicacion[$i]) !== false){
                        
                         echo 'LINK REVISANDO --> '.$element->href.'<br>';
                      //se guarda el link y el doc en la BD
                      $encuentra_ubic=false;
                      $html2 = new \Htmldom($element->href);
                    
                      //extrauyendo la fecha y titulo de la noticia del eluniversal
                      if($getDate==1){
                          $ret = $html2->find("time[class=date]"); 
                          $fecha_notic=$ret[0]->attr['datetime'];
                          $tittle_notice=$html2->find('h1[class=tittle]'); 
                          $articulo='';
                      //extrayendo el parrafo del link de la noticia
                      foreach($html2->find('p[style]') as $element2){
                          //concatenando los parrafos del html
                          $articulo=$articulo.$element2;
                          
                      }
                      }else{
                             //extrauyendo la fecha y titulo de la noticia del nacional
                          if($getDate==2){
                              $fecha_notic = $html2->find("time[class=date]",0)->plaintext;
                              $tittle_notice=$html2->find('header[class=detail-header]',0)->plaintext; 
                              $articulo='';
                                      //extrayendo el parrafo del link de la noticia
                                      foreach($html2->find('p[style=text-align: justify;]') as $element2){
                                          //concatenando los parrafos del html
                                          $articulo=$articulo.$element2;
                                          
                                      }
                          }else{
                               //extrauyendo la fecha y titulo de la noticia del ultimasnoticias
                              if($getDate==3){
                                   $fecha_notic = $html2->find("span[class=entry-meta]",0)->children(1)->plaintext;
                                     $tittle_notice=$html2->find('h1[class=entry-title h1]',0)->plaintext; 
                                     $articulo='';
                                      //extrayendo el parrafo del link de la noticia
                                      foreach($html2->find('p') as $element2){
                                          //concatenando los parrafos del html
                                          $articulo=$articulo.$element2;
                                          
                                      }
                                      
                              }else{
                                  //extrauyendo la fecha y titulo de la noticia del caraotadigital
                                  if($getDate==4){
                                       $fecha_notic = $html2->find("time[class=entry-date updated]",0)->plaintext;
                                      
                                     $tittle_notice=$html2->find('h1[class=entry-title]',0)->plaintext; 
                    
                                     $articulo='';
                                      //extrayendo el parrafo del link de la noticia
                                      foreach($html2->find('p') as $element2){
                                          //concatenando los parrafos del html
                                          $articulo=$articulo.$element2;
                                          
                                      }
                                  }
                              }
                          }
                      }
                     
                      
                      
                      //quita las etiquetas html y deja el txt en utf-8
                      $articulo_normalizado=strip_tags(html_entity_decode($articulo, ENT_HTML5, 'UTF-8'));
                       $collection= array(1=>$this->limpiar($articulo_normalizado));
                       dd($collection);
                     //dd($this->limpiar($articulo_normalizado));
                     
                     $this->principal($collection);
                
                     // $stem = $stemmer->stem('asesinó');
                     // $stem = $stemmer->stem('asesinaron');
                     // $stem = $stemmer->stem('secuestro');
                    //dd($stem);
                      //echo $articulo;
                      //dd($articulo);
                      //llamar a func limpiar palabra con $articulo
                     
                   }
                  $i++;
              }
           }
        } 
    }

    /*Funcion para sustituir caracteres especiales dentro del articulo*/
    
     public function limpiar($string) {
    //$string = utf8_encode($string);   
    $string = preg_replace('/\s+/', ' ', trim($string));
    $string = str_replace(
      array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0'),
      '',
      $string
    );

       $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    $string = stripcslashes($string);

    $string = str_replace(
      array( "¨", "º", "-", "~",
         "#", "@", "|", "!",
         "·", "$", "%", "&", "/",
         "(", ")", "?", "'", "¡",
         "¿", "[", "^", "`", "]",
         "+", "}", "{", "¨", "´",
         ">", "< ", ";", ",", ":",
         ".", '"', "“", "”","nbsp", "—","_"),
      ' ',
      $string
    );

    $string = str_replace(
      array('A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
      array('a','b','c','d','e','f','g','h','i','j','k','l','m',
            'n','ñ','o','p','q','r','s','t','u','v','w','x','y','z'),
      $string
    );

    $string = " ".$string." ";

    $string = str_replace(
      array(' el ','ap','esta ',' estas ',' este ',' estos ',
      ' ultima ',' ultimas ',' ultimo ',' ultimos ',' a ',
      ' anadio ',' aun ',' actualmente ',' adelante ',
      ' ademas ',' afirmo ',' agrego ',' ahi ',' ahora ',
      ' al ',' algun ',' algo ',' alguna ',' algunas ',
      ' alguno ',' algunos ',' alrededor ',' ambos ',' ante ',
      ' anterior ',' antes ',' apenas ',' aproximadamente ',
      ' aqui ',' asi ',' aseguro ',' aunque ',' ayer ',' bajo ',
      ' bien ',' buen ',' buena ',' buenas ',' bueno ',
      ' buenos ',' como ',' cada ',' casi ',' cerca ',
      ' cierto ',' cinco ',' comento ',' como ',' con ',
      ' conocer ',' considero ',' considera ',' contra ',
      ' cosas ',' creo ',' cual ',' cuales ',' cualquier ',
      ' cuando ',' cuanto ',' cuatro ',' cuenta ',' da ',
      ' dado ',' dan ',' dar ',' de ',' debe ',' deben ',
      ' debido ',' decir ',' dejo ',' del ',' demas ',
      ' dentro ',' desde ',' despues ',' dice ',' dicen ',
      ' dicho ',' dieron ',' diferente ',' diferentes ',
      ' dijeron ',' dijo ',' dio ',' donde ',' dos ',
      ' durante ',' e ',' ejemplo ',' el ',' ella ',' ellas ',
      ' ello ',' ellos ',' embargo ',' en ',' encuentra ',
      ' entonces ',' entre ',' era ',' eran ',' es ',' esa ',
      ' esas ',' ese ',' eso ',' esos ',' esta ',' estan ',
      ' esta ',' estaba ',' estaban ',' estamos ',' estar ',
      ' estara ',' estas ',' este ',' esto ',' estos ',
      ' estoy ',' estuvo ',' ex ',' existe ',' existen ',
      ' explico ',' expreso ',' fin ',' fue ',' fuera ',
      ' fueron ',' gran ',' grandes ',' ha ',' habia ',
      ' habian ',' haber ',' habra ',' hace ',' hacen ',
      ' hacer ',' hacerlo ',' hacia ',' haciendo ',' han ',
      ' hasta ',' hay ',' haya ',' he ',' hecho ',' hemos ',
      ' hicieron ',' hizo ',' hoy ',' hubo ',' igual ',
      ' incluso ',' indico ',' informo ',' junto ',' la ',
      ' lado ',' las ',' le ',' les ',' llego ',' lleva ',
      ' llevar ',' lo ',' los ',' luego ',' lugar ',' mas ',
      ' manera ',' manifesto ',' mayor ',' me ',' mediante ',
      ' mejor ',' menciono ',' menos ',' mi ',' mientras ',
      ' misma ',' mismas ',' mismo ',' mismos ',' momento ',
      ' mucha ',' muchas ',' mucho ',' muchos ',' muy ',
      ' nada ',' nadie ',' ni ',' ningun ',' ninguna ',
      ' ningunas ',' ninguno ',' ningunos ',' no ',' nos ',
      ' nosotras ',' nosotros ',' nuestra ',' nuestras ',
      ' nuestro ',' nuestros ',' nueva ',' nuevas ',' nuevo ',
      ' nuevos ',' nunca ',' o ',' ocho ',' otra ',' otras ',
      ' otro ',' otros ',' para ',' parece ',' parte ',
      ' partir ',' pasada ',' pasado ',' pero ',' pesar ',
      ' poca ',' pocas ',' poco ',' pocos ',' podemos ',
      ' podra ',' podran ',' podria ',' podrian ',' poner ',
      ' por ',' porque ',' posible ',' proximo ',' proximos ',
      ' primer ',' primera ',' primero ',' primeros ',
      ' principalmente ',' propia ',' propias ',' propio ',
      ' propios ',' pudo ',' pueda ',' puede ',' pueden ',
      ' pues ',' que ',' que ',' quedo ',' queremos ',
      ' quien ',' quien ',' quienes ',' quiere ',' realizo ',
      ' realizado ',' realizar ',' respecto ',' si ',' solo ',
      ' se ',' senalo ',' sea ',' sean ',' segun ',' segunda ',
      ' segundo ',' seis ',' ser ',' sera ',' seran ',' seria ',
      ' si ',' sido ',' siempre ',' siendo ',' siete ',
      ' sigue ',' siguiente ',' sin ',' sino ',' sobre ',
      ' sola ',' solamente ',' solas ',' solo ',' solos ',
      ' son ',' su ',' sus ',' tal ',' tambien ',' tampoco ',
      ' tan ',' tanto ',' tenia ',' tendra ',' tendran ',
      ' tenemos ',' tener ',' tenga ',' tengo ',' tenido ',
      ' tercera ',' tiene ',' tienen ',' toda ',' todas ',
      ' todavia ',' todo ',' todos ',' total ',' tras ',
      ' trata ',' traves ',' tres ',' tuvo ',' un ',' una ',
      ' unas ',' uno ',' unos ',' usted ',' va ',' vamos ',
      ' van ',' varias ',' varios ',' veces ',' ver ',' vez ',
      ' y ',' ya ',' yo ',' lunes ',' martes ',' miercoles ',' jueves ',
      ' viernes ',' sabado ',' domingo ',' anos ',' desayunaba ',
      ' luncheria ',' centro ',' comercial ',' coche '), ' ',$string);

      return $string;
  }
  
  ///DESDE AQUI
  
  private function getIndex($collection) {
        //    $collection = array(
          //          1 => 'this string is a short string but a good string',
            //        2 => 'this one isn\'t quite like the rest but is here',
              //      3 => 'this is a different short string that\' not as short'
            // );
    
            $dictionary = array();
            $docCount = array();
    
            foreach($collection as $docID => $doc) {
                    $terms = explode(' ', $doc);
                    $docCount[$docID] = count($terms);
    
                    foreach($terms as $term) {
                            if(!isset($dictionary[$term])) {
                                    $dictionary[$term] = array('df' => 0, 'postings' => array());
                            }
                            if(!isset($dictionary[$term]['postings'][$docID])) {
                                    $dictionary[$term]['df']++;
                                    $dictionary[$term]['postings'][$docID] = array('tf' => 0);
                            }
    
                            $dictionary[$term]['postings'][$docID]['tf']++;
                    }
            }
       
            return array('docCount' => $docCount, 'dictionary' => $dictionary);
    }
    private function getTfidf($term) {
            $index = $this->getIndex();
            $docCount = count($index['docCount']);
            $entry = $index['dictionary'][$term];
            foreach($entry['postings'] as  $docID => $postings) {
                    echo "Document $docID and term $term give TFIDF: " .
                            ($postings['tf'] * log($docCount / $entry['df'], 2));
                    echo "\n";
            }
    }
    private function normalise($doc) {
        foreach($doc as $entry) {
                $total += $entry*$entry;
        }
        $total = sqrt($total);
        foreach($doc as &$entry) {
                $entry = $entry/$total;
        }
        return $doc;
    }
    private function cosineSim($docA, $docB) {
            $result = 0;
            foreach($docA as $key => $weight) {
                    $result += $weight * $docB[$key];
            }
            return $result;
    }
    
    public function principal($collection){
        $query = array('is', 'short', 'string');

        $index = $this->getIndex($collection);
       
        $matchDocs = array();
        $docCount = count($index['docCount']);
 
        foreach($query as $qterm) {
           dd($index);
            $entry = $index['dictionary'][$qterm];
               
                foreach($entry['postings'] as $docID => $posting) {
                   
                        $matchDocs[$docID] =
                                        $posting['tf'] *
                                        log($docCount + 1 / $entry['df'] + 1, 2);
                }
        }

        // length normalise
        foreach($matchDocs as $docID => $score) {
                $matchDocs[$docID] = $score/$index['docCount'][$docID];
        }
        
        arsort($matchDocs); // high to low
        
        var_dump($matchDocs);
    }
  
  
  
}
