<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatereadHtmlAPIRequest;
use App\Http\Requests\API\UpdatereadHtmlAPIRequest;
use App\Models\readHtml;
use App\Repositories\readHtmlRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Wamania\Snowball\Spanish;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\twitterAPIController;
use Illuminate\Support\Facades\Log;
/**
 * Class readHtmlController
 * @package App\Http\Controllers\API
 */
class readHtmlAPIController extends AppBaseController
{
    
   
    /*Funcion Principal llamada por el Daemon*/
    public  function start(){  
        //NOTICIAS  EL UNIVERSAL
       $link='http://www.eluniversal.com/sucesos/';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=1;
        $this->AnalizarHTML($link,$web,$getDate);
        
       //NOTICIAS SECUESTROS EL UNIVERSAL
     $link='http://www.eluniversal.com/localizador/secuestros';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=1;
        $this->AnalizarHTML($link,$web,$getDate);
        
       //NOTICIAS ASESINATOS EL UNIVERSAL
    $link='http://www.eluniversal.com/localizador/asesinatos';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=1;
        $this->AnalizarHTML($link,$web,$getDate);
        
        //NOTICIAS HOMICIDIOS EL UNIVERSAL
        $link='http://www.eluniversal.com/localizador/homicidio';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $this->AnalizarHTML($link,$web,1);
        
        //NOTICIAS ROBOS EL UNIVERSAL
     $link='http://www.eluniversal.com/localizador/robos';
       $web='http://www.eluniversal.com/noticias/sucesos/';
       $this->AnalizarHTML($link,$web,1);
        
        //NOTICIAS SUCESOS EL NACIONAL
      /* $link='http://www.el-nacional.com/sucesos/';
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
        //////////////de aqui para arriba son las web que se analizan  del resto todo explota ! 
        
         //NOTICIAS sucesos elsiglo
        $link='https://elsiglo.com.ve/internasucesos/';
        $web='https://elsiglo.com.ve/noticias-sucesos/';
        $getDate=5;
        $this->AnalizarHTML($link,$web,$getDate);
        //NOTICIAS sucesos elsiglo
        $link='https://www.el-carabobeno.com/secciones/noticias/sucesos/';
        $web='https://www.el-carabobeno.com/';
        $this->AnalizarHTML($link,$web,8);
        
          $link='http://www.notitarde.com/sucesos/';
        $web='http://www.notitarde.com/';
        $this->AnalizarHTML($link,$web,9);
        
         $link='https://diariolavoz.net/sucesos/';
        $web='https://diariolavoz.net/';
        $this->AnalizarHTML($link,$web,10);*/
        
       
    }
    //PROCESAMIENTO DE HTML
    public function AnalizarHTML($url,$web,$getDate){
        //$stemmer = new Spanish(); para 
        $html = new \Htmldom($url);
        // muestra todo los parrafos 
        ///foreach($html->find('article') as $element) 
        //extrayendo los links de sucesos 
                switch ($getDate) {
                    case 1:
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
                                $this->getNotice("p[class=clearfix]",'h2[class=title]', $html2,'div[class=note-text] p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 2:
                        foreach($html->find('a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                                
                                if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                $this->getNotice("time[class=date]",'header[class=detail-header] h1', $html2,'div[class=detail-body] p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 3:
                        foreach($html->find('a') as $element) {
                                //compara si el substring existe en el link        
                                //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                                
                                $pos = strpos($element-> href, $web);
                                
                                if($pos!==false){
                                    
                                    //busca la ubicacion del suceso
                                    echo 'LINKs --> '.$element->href.'<br>';
                                    //se guarda el link y el doc en la BD
                                    
                                    $html2 = new \Htmldom($element->href);
                                    $this->getNotice("span[class=entry-meta] span",'h1[class=entry-title h1]', $html2,'div[class=entry-content herald-entry-content] p',$element->href);
                                }//end if 
                            } //end for
                        break;
                    case 4:
                        foreach($html->find('a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                            
                            if($pos!==false){
                            
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                $this->getNotice("div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 fechaHora]" ,"div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo] <h1>", $html2,'div[class=col-xs-12 col-sm-12 col-md-12 col-lg-12 contenido] p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 5:
                        foreach($html->find('a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                            
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                $this->getNotice("time[class=entry-date updated td-module-date]" ,"div[class=td-post-header] header h1", $html2,'p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 6:
                        foreach($html->find('a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                            
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                $html2 = new \Htmldom('http://globovision.com'.$element->href);
                                //globovvision
                                $this->getNotice("time[class=date]" ,"h1[class=article-title]", $html2,'div[class=article-body] div p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 7:
                        foreach($html->find('a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                            
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                $this->getNotice("time[class=date]" ,"h1[class=article-title]", $html2,'div[class=article-body] div p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 8:
                        foreach($html->find('h3[class=entry-title td-module-title] a') as $element) {
                            //compara si el substring existe en el link        
                            //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
                            
                            $pos = strpos($element-> href, $web);
                            
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                //carabobeño
                                $this->getNotice("header[class=td-post-title] div span" ,"header[class=td-post-title] h1", $html2,'p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 9:
                        foreach($html->find('h3 a') as $element) {
                            
                            $pos = strpos($element-> href, $web);
                           
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                //carabobeño
                                $this->getNotice("div[class=td-module-meta-info] span[class=td-post-date td-post-date-no-dot]" ,"header[class=td-post-title] h1", $html2,'div[class=td-post-content] p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    case 10:
                        foreach($html->find('div[class=entry clearfix post-377621 post type-post status-publish format-standard hentry category-sucesos] h1 a') as $element) {
                            //compara si el substring existe en el link        
                            
                            
                            $pos = strpos($element-> href, $web);
                          
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                echo 'LINKs --> '.$element->href.'<br>';
                                //se guarda el link y el doc en la BD
                                
                                $html2 = new \Htmldom($element->href);
                                //carabobeño
                                $this->getNotice("div[class=entry clearfix post-377621 post type-post status-publish format-standard hentry category-sucesos] div[class=meta-box]","div[class=entry clearfix post-377621 post type-post status-publish format-standard hentry category-sucesos] h1", $html2,'div[id=post-content] p',$element->href);
                            }//end if 
                        } //end for
                        break;
                    default:
                        // code...
                        break;
                }
               /* if($getDate==1){
                   
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
                                  
                                $this->getNotice("time[class=entry-date updated td-module-date]" ,"div[class=td-post-header] header h1", $html2,'p',$element->href);                               
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
                }*/
    }
        /*Funcion para leer la noticia y extraer sus datos*/
    public function getNotice($Str_fecha, $Str_tittle, $html2, $Str_parrafo,$link){
        //Vector de ubicaciones 
        //vector con las posibles ubicacions de los sucesos
        //$ubicacion= $this->ubicaciones();
        $fecha_notic = $html2->find($Str_fecha,0)->plaintext;
       
        $tittle_notice=$html2->find($Str_tittle,0)->plaintext;
        $tittle_normalizado=strip_tags(html_entity_decode($tittle_notice, ENT_HTML5, 'UTF-8'));
        $tittle_notice=($this->limpiar_caracteres_esp($tittle_normalizado));
        //dd($tittle_normalizado);
         Log::info('titulo--> '. ($tittle_notice).'<br>');
       // $articulo='';
       // $encuentraUbic=false;
       // while ($i<sizeof($ubicacion) && $encuentraUbic==false){
            //extrayendo el parrafo del link de la noticia
            //verificando que cumpla con la ubicacion
           // if(strpos(strtolower ($tittle_notice), $ubicacion[$i]) !== false){
                echo 'LINK REVISANDO --> '.$link.'<br>';
                //$encuentraUbic=true;
                $articulo='';
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
                    'ubicacion'=>'null',
                    'fecha'=> $fecha_notic,
                    'contenido'=> $articulo_normalizado
                    ]);
                }
            //}
        //$i++;   
        //}
    }
    /*Funcion para sustituir caracteres especiales dentro del articulo*/
    public function limpiar_caracteres_esp($string) {
    $string = utf8_encode($string);  
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
    
    return $string;
  }
        /*funcion para eliminar palabras irrelevantes de los documentos*/
    /*NO TOQUES ESTO JHESSICA !!!! NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LO TO QUESSSSSSSSSSSSSSSSS*/
    public function limpiar_palabras($documento, $termino){
        foreach($documento as &$index){
            $index=($this->limpiar_caracteres_esp($index));
            $index = explode(" ", $index); //convirtiendo el string en un array
            for($i=0;$i<sizeof($index);$i++){
                $stemmer = new Spanish();
                $index[$i]=$stemmer->stem($index[$i]);
            }
            $index = array_intersect($index, $termino); //
            $array=array();
            foreach($index as &$index2){
                $index2=DB::table('termino')->where('nombre',$index2)->value('nombre');
            }
        }
       return $documento;
    }
    /*NO TOQUES ESTO JHESSICA !!!! NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LO TO QUESSSSSSSSSSSSSSSSS*/
    public function get_tf_idf($documento){
        $termino = db::table('termino')->pluck('nombre','id');
        $documento = $this->limpiar_palabras($documento,$termino->all());
        $index = $this->make_diccionary($documento);
        $matchDocs = array();
        $docCount = count($index['docCount']);
       // $docCount = count($collection);
        foreach($documento as $idDoc  => $doc){
           // $terms = explode(' ', $doc);
            $vector = array();
            foreach($doc as $idTerm => $term){
                $entry = $index['dictionary'][$term];
                $vector[$term] = ($entry['postings'][$idDoc]['tf'] * log($docCount / $entry['df'], 2));
               //Validacion de clave unica
                $id_term=db::table('termino')->where('nombre',$term)->value('id');
                $consulta=db::table('tf_idt')->where([
                        ['documento_id', '=', $idDoc],
                        ['termino_id', '=', $id_term],
                    ])->get();
                if(sizeof($consulta)<1){
                    //insertando en la bd los valores de tfidf
                    db::table('tf_idt')->insert(['termino_id'=>$id_term,
                                                'documento_id'=>$idDoc,
                    'tf_idf'=>($entry['postings'][$idDoc]['tf'] * 
                    log($docCount / $entry['df'], 2))]);     
                }
            }
        }
    }
    /*NO tocar !!!! NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO LO TO QUESSSSSSSSSSSSSSSSS*/
    private function make_diccionary($documento) {
        $dictionary = array();
        $docCount = array();
        foreach($documento as $docID => $doc) {
            // $terms = explode(' ', $doc);
            $docCount[$docID] = count($doc);
            foreach($doc as $term) {
                if(!isset($dictionary[$term])) {
                        $dictionary[$term] = array('df' => 0, 'postings' => array());
                }
                if(!isset($dictionary[$term]['postings'][$docID])) {
                    $dictionary[$term]['df']++;
                    $dictionary[$term]['postings'][$docID] = array('tf' => 0);
                }
                $dictionary[$term]['postings'][$docID]['tf']++; //repeticion de terminos
                $query=DB::table('termino')->where('nombre',$term)->value('id');
                $data=DB::table('documento')->where('id',$docID)->value('contenido');
                $consulta=DB::table('tf_idt')->where([['documento_id', '=', $docID],['termino_id', '=', $query]])->get();
               
              /*  if(sizeof($consulta)==0){
                    DB::table('tf_idt')->insert(['documento_id'=>$docID,'termino_id'=>$query,'frecuencia'=>($dictionary[$term]['postings'][$docID]['tf']/str_word_count($data))]);
                }*/
            }
        }
        return array('docCount' => $docCount, 'dictionary' => $dictionary);
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
    /*REVISAR LLAMADAS*/
    private function cosineSim($docA, $docB) {
            $result = 0;
            foreach($docA as $key => $weight) {
                    $result += $weight * $docB[$key];
            }
            return $result;
    }
    //Pre-procesamiento Datos TFIDF en matriz para kmeans
    public function insertMatrizkmeans(){
        //si el termino N no tiene relevancia en el documento 
        //se coloque 0 en esa posicion para q los vectores queden en paralelo
        $data = array();
        $queryDoc=DB::table('documento')->pluck('id');
        $query = DB::table('tf_idt')->get();
        $query2= DB::table('termino')->pluck('id');
    // dd($query);
    $relevancia_array=array();
        foreach ($queryDoc->all() as $idDoc=> $value) {
            foreach($query2->all() as $idTerm => $term){
                for($i=0;$i<sizeof($query);$i++){
                    if(($query[$i]->documento_id==$value) && ($query[$i]->termino_id==$term)){
                         $relevancia_array[$value][$term]=$query[$i]->tf_idf;
                    }
                }
            }
        }
   /*$relevancia_array = array(
        array(0,0,6.78,0,0,0,0,0,0,0,0,0,0,0,0),
        array(2.81,2.39,0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,1.81,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,1.81,0,0,0,0,0,0,0,0,0,0,0),
        array(0,2.39,0,0,0,0,0,0,0,4.39,0,0,0,0,0),
        array(2.81,0,0,1.81,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,10.18,0,0,0,0,0,0,0,0,0,0,0,0),
        array(2.81,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,1.81,0,0,0,0,0,0,0,0,0,0,0),
        array(0,2.39,0,0,0,0,0,0,0,0,0,0,0,0,0),
        array(0,2.39,0,1.81,0,0,0,0,0,0,0,0,0,0,0),
        array(0,0,0,1.81,0,0,0,0,0,0,0,0,0,0,0),

);*/
        return $this->kMeans($relevancia_array, 3);
    }
    // Algoritmo de Agrupamiento K-MEANS
    public function kMeans($datos, $k) {
        //borrar los datos de los clusters anteriores
        DB::table('centroides')->truncate();
        //generar los nuevos clusters
        $mapping = array(); //id doc y id del cluster lo q retorna
        $centroides = $this->initialiseCentroids($datos,$k); //selecciona cada centroide aleatoriamente dpnd cant cluster
        $cambio = false; //band para saber si no camb ningun centroide
        while(!$cambio){
            $new_mapping = $this->asignarCentroides($datos,$centroides); //det q doc estan cercanos x distancia euclideana al centroide
            if($mapping === $new_mapping){
                $cambio = true;
            }else {
                $mapping = $new_mapping;
                $centroides = $this->actualizarCentroides($mapping,$datos,$k);
            }
        }
        //guarada el mapping de kmeans en la BD
        foreach ($mapping as $id=>$value) {
            DB::table('documento')->where('id',$id)->update(['cluster' => $value]);
        }
        $resul['mapping'] = $mapping;
        $resul['centroides'] = $centroides; //coordenadas de cada centroide x aqui se indexan las busq del usuario
        //guarda los datos de los nuevos clusters para la busqueda del usuario
        foreach ($centroides as $idCentroid=>$value){
            foreach($value as $idterm=>$valueTerm){
                DB::table('centroides')->insert(
                    ['id_centroide' => $idCentroid, 'id_termino' => $idterm, 'valor' => $valueTerm]
                );
            }
        }
        return $resul;
    }
    public function initialiseCentroids(array $data, $k) {
        
        $dimensions =15; //DANIEL CTM PQ PUSISTE 2 HAY QUE PROBAR CON count($data[0]);
        $centroids = array();
        $dimmax = array();
        $dimmin = array();
        foreach($data as $document) {
            foreach($document as $dimension => $val) {
                if(!isset($dimmax[$dimension]) || $val > $dimmax[$dimension]) {
                    $dimmax[$dimension] = $val;
                }
                if(!isset($dimmin[$dimension]) || $val < $dimmin[$dimension]) {
                    $dimmin[$dimension] = $val;
                }
            }
        }
        for($i = 0; $i < $k; $i++) {
            $centroids[$i] = $this->initialiseCentroid($dimensions, $dimmax, $dimmin);
        }
        return $centroids;
    }
    public function initialiseCentroid($dimensions, $dimmax, $dimmin) {
        $total = 0;
        $centroid = array();
       
        foreach($dimmin as $idDim=>$value) {
            $centroid[$idDim] = (rand($dimmin[$idDim] * 1000, $dimmax[$idDim] * 1000));
            $total += $centroid[$idDim]*$centroid[$idDim];
        }
        /*for($j = 0; $j < $dimensions; $j++) {
            $centroid[$j] = (rand($dimmin[$j] * 1000, $dimmax[$j] * 1000));
            $total += $centroid[$j]*$centroid[$j];
        }*/
        $centroid = $this->normaliseValue($centroid, sqrt($total));
        
        return $centroid;
    }
    /* funcion para normalizar los documentos */
    public function normaliseValue(array $vector, $total) {
        foreach($vector as $key => $value) {
          $vector[$key] = $value/$total;
        }
        return $vector;
    }
    public function asignarCentroides($doc, $centroides){
        $mapping = array();
        foreach ($doc as $id => $vector) {//Probar sin este for
            $short = 0;
            $cluster = null;
            foreach ($centroides as $key => $centroid) { //p cada docc
                $dist = 0;
                $total = $this->norma($vector)*$this->norma($centroid);
                foreach ($vector as $idword => $word) { //p cada centroide
                    if(isset($centroid[$idword])){
                        log::info('doc--> '.$id .' centroides --> '.$key.'vector--> '.$idword.'<br>');
                    $dist += $centroid[$idword]*$word;
                    }
                }
                $dist = $dist/$total;
                if($dist >= $short){
                    $short = $dist;
                    $cluster = $key;
                }
            }
            $mapping[$id] = $cluster;
        }
        return $mapping;
    }
    
    public function norma($vector){
        $total = 0;
        foreach ($vector as $key => $value) {
            $total = $total + ($value*$value);
        }
        $total= sqrt($total);
        return($total);
    }
    public function actualizarCentroides($mapping, $doc, $k){
        $centroides = array();
        $denominador = array_count_values($mapping);
        foreach ($mapping as $key => $value) { //RECORRE EL MAPING Y TRAE EL ID DOC
            foreach ($doc[$key] as $idword => $valor) { //RECORRE POR DOCUMENTO $Datos
                if(!isset($centroides[$value][$idword])){
                    $centroides[$value][$idword] = 0;
                }
                $centroides[$value][$idword] += $valor/$denominador[$value]; //VALOR DEL CENTROIDE
               // dd($centroides[$value][$idword]);
            }
            
        }
        
        if(count($centroides) < $k) {
            $centroides = array_merge($centroides, $this->initialiseCentroids($doc, $k - count($centroides)));
        }
        return $centroides;
    }
    // funcion para extraer noticias de TWITTER 
    public function twitter($user){
        $settings = array(
            'oauth_access_token'        => "235398464-pNzUPZuZSUcRb1iq7e5Ukfg2jBXpauHOnekxofCz",
            'oauth_access_token_secret' => "ZIybRwIm9AQfWnhEU8qBH5ghVg8nTZ6JjcrlneVbccPj8",
            'consumer_key'              => "0MgSHoWzhoHo9lKneieiPul1B",
            'consumer_secret'           => "LFNBsXeikJIkhVASrnubUf43RXHXdJUVpAqthdiqWqcjqUVZnm",
        );
        /**
         * [$url es el recurso de la API Twitter 
         * explicacion https://developer.twitter.com/en/docs/tweets/timelines/api-reference/get-statuses-user_timeline.html]
         * @var string
         */
        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $getfield = '?q=muerto+OR+robó+OR+mató+OR+asesinó+OR+asesinaron+OR+mataron+OR+violaron+OR+secuestraron+OR+robaron+AND+FROM:'.$user.'&count=200';
      /*OR+mató+OR+asesinó+OR+asesinaron+OR+mataron+OR+violaron+OR+secuestraron+O
        R+robaron+OR+mueren+OR+asesinan+OR+queman+OR+violan+OR+roban+OR+secuestran+FROM';*/
       /* %20OR%20from%3AElUniversal%20OR%20from%3ACiudadCCS%20OR%20from%3Ael_carabobeno%20OR%20from%3ACaraotaDigital%20OR%20from%3Aelclarinweb%20OR%20from%3AUNoticias%20OR%20from%3ADiario_ElTiempo';  */
        $requestMethod = 'GET';
        $twitter = new twitterAPIController($settings);
        $result =  $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
        $tweets = json_decode($result);
      //echo sizeof($tweets);
       // ($tweets);
        foreach($tweets->statuses as $tweet){
          // (strlen($tweet->text));
            echo/* $tweet->created_at." - ".$tweet->text."<br>".'---->'*/substr($tweet->text,-23).'<br>';  // devuelve "abcde";
           //insert BD
            //verificando que no exista ese titulo en la BD para no guardarlo en la BD
            //entidades estan las urls 
            $consultaTitulo=DB::table('documento')->where('titulo',$tweet->text)->get();
                //guardando en la BD
               /*if(sizeof($consultaTitulo)<1){
                  DB::table('documento')->insert(
                   ['titulo' => $tweet->text, 
                   'link' => $link,
                 'ubicacion'=>$ubicacion[$i],
                   'fecha'=> $fecha_notic,
                   );
                }*/
        }
    }
    public function search(){
        $result=DB::table('documento')->pluck('ubicacion');
        return $this->sendResponse($result,'200');
    }
    public function getDocumentosDB(){
        $arry=DB::table('documento')->pluck('contenido','id');
       // $this->cluster($arry->all());
        $this->get_tf_idf($arry->all()); //llamada TF IDF
        return $this->sendResponse($this->insertMatrizkmeans(),200);
    }
    //PROCESAMIENTO DE LA BUSQUEDA
    public function filtrar(Request $request){
        $doc=(($request->input('string')));
     
        $documento[]=$doc;
        $query=$this->tf_idfBusqueda($documento);
        $count=dB::table('termino')->count();
        $centroides=array();
        for($i=0;$i<3;$i++){
           $centroides[$i] = DB::table('centroides')->where('id_centroide',$i)->get();
        }
        $vectorBusqueda=array();
        for($o=1;$o<=$count;$o++){
            $vectorBusqueda[$o]=0;
        }
        foreach($query as $id=>$value){
            $vectorBusqueda[$id]=$value;
        }
        $menor=-1;
        //buscando el centroide mas similar
        foreach($centroides as $idcentroid=>$value){
            $vectorCentroide=array();
            //iniciaizo el vector para el centroide
            for($o=1;$o<=$count;$o++){
                $vectorCentroide[$o]=0;
            }
            //lleno el vector para el centroide
            foreach ($value as $idValue=>$valor) {
               $vectorCentroide[$valor->id_termino]=$valor->valor;
            }
            //dd($vectorBusqueda);
            //calculo la distancia del vector centroide yla busqueda
            $axu=$this->distanciaCentroides($vectorBusqueda,$vectorCentroide);
            //echo $axu.$value.'<br>';
            //almaceno el menor y su id de cluster
            if($axu>=$menor){
               $menor=$axu;
               $id_cluster=$idcentroid;
           }
        }
        //calcular similitud de los documentos del centroide con la busqueda
        $noticias_cluster= DB::table('documento')->select('id')->where('cluster',$id_cluster)->get();
        $cant_noticias=sizeof($noticias_cluster->all());
        //consulto tf idf de cada documento
        //dd($noticias_cluster);
        $vector_noticia=array();
        $result=array();
        foreach($noticias_cluster->all() as $idDoc=>$value){
            
            for($o=1;$o<=$count;$o++){
                $vector_noticia[$o]=0;
            }
            $query=DB::table('tf_idt')->where('documento_id',$value->id)->get();
            foreach($query->all() as $id=>$valor){
                $vector_noticia[$valor->termino_id]=$valor->tf_idf;
            }
            
            $result[$value->id]=$this->distanciaCentroides($vectorBusqueda, $vector_noticia);
        }
        
       
        arsort ($result);
      
       $result2=array();
          $ubicaion=DB::table('ubicacion')->get();
        foreach($result as $id=>$value){
         
          $query= DB::table('documento')->where('id',$id)->get();
          $this->verificarUbicacion($query[0],$ubicaion->all());
          $result2[]=$query;
        }
        
       return $this->sendResponse($result2,'200');
    }
    //TF IDF BUSQUEDA
    public function tf_idfBusqueda($documento){
            $termino = db::table('termino')->pluck('nombre','id');
            $documento = $this->limpiar_palabras($documento,$termino->all());
          
            $index = $this->make_diccionary($documento);
            $matchDocs = array();
            $docCount = count($index['docCount']);
             
           // $docCount = count($collection);
          
            $vector = array();
            foreach($documento as $idDoc  => $doc){
               // $terms = explode(' ', $doc);
               
                foreach($doc as $idTerm => $term){
                    $entry = $index['dictionary'][$term];
                    $vector[$term] = ($entry['postings'][$idDoc]['tf'] * log($docCount + 1/ $entry['df']+ 1, 2));
                   
                }
            }
             $result=array();
            foreach ($vector as $idterm=>$value) {
                $id=DB::table('termino')->where('nombre',$idterm)->value('id');
                 $result[$id]=$value;
                
            }
           return ($result);
    }
    //DISTANCIA EUCLIDIANA DE LA BUSQUEDA CON LSO CENTROIDES
    public function distanciaCentroides($vector, $centroides){
            $short = 0;
            $cluster = null;
            $key=0;
                $dist = 0;
                $total = $this->norma($vector)*$this->norma($centroides);
            
                foreach ($vector as $idword => $word) { //p cada pos del vect doc
                    if(isset($centroides[$idword])){
                        $dist += $centroides[$idword]*$word;
                    }
                }
                if($total>0){
                    $dist = $dist/$total;
                    if($dist >= $short){
                        $short = $dist;
                        $cluster = $key;
                        $key=$key+1;
                    }
                }
               
        //dd($dist);
        return $dist;
    }
    public function getLocations(){
        $locatiosnsDB=DB::table('documento')->pluck('ubicacion');
        $result=$locatiosnsDB->toArray();
        $result=array_unique($result);
        return $this->sendResponse($result,200);
    }
    public function getDocumentosDBBusqueda(){
        $arry=DB::table('documento')->pluck('contenido','id');
        $this->get_tf_idf($arry->all()); //llamada TF IDF
        return $this->insertMatrizkmeans();
    }
    //verifica la ubicacion que ingreso el usuario
    public function verificarUbicacion($objet,$ubicaion){
        $i=0;
        $band=false;
        
        while($i<sizeof($ubicaion) && !$band){
            if(strpos($objet->titulo, $ubicaion[0]->ubicacion)==true){
                db::table('documento')->where('id',$object->id)->update(['ubicacion'=>$ubicaion[0]->ubicacion]);
                $band=true;
            }
            $i++;
        }
    }
    
}