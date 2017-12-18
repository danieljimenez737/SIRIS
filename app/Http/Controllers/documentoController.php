<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedocumentoRequest;
use App\Http\Requests\UpdatedocumentoRequest;
use App\Repositories\documentoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\readHtml;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class documentoController extends AppBaseController
{
    /** @var  documentoRepository */
    private $documentoRepository;

    public function __construct(documentoRepository $documentoRepo)
    {
        $this->documentoRepository = $documentoRepo;
    }

    /**
     * Display a listing of the documento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentoRepository->pushCriteria(new RequestCriteria($request));
        $documentos = db::table('documento')->paginate(10);

        return view('documentos.index')
            ->with('documentos', $documentos);
    }

    /**
     * Show the form for creating a new documento.
     *
     * @return Response
     */
    public function create()
    {
        return view('documentos.create');
    }

    /**
     * Store a newly created documento in storage.
     *
     * @param CreatedocumentoRequest $request
     *
     * @return Response
     */
    public function store(CreatedocumentoRequest $request)
    {
        $input = $request->all();

      $documentos = db::table('documento')->insert(['titulo'=>$input['titulo'],'link'=>$input['link'],
      'fecha'=>$input['fecha'],'ubicacion'=>$input['ubicacion'],'contenido'=>$input['contenido']
      ]);

        Flash::success('Documento saved successfully.');

        return redirect(route('documentos.index'));
    }

    /**
     * Display the specified documento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
          $documento = db::table('documento')->where('id',$id)->get();

        if (empty($documento)) {
            Flash::error('Documento not found');

            return redirect(route('documentos.index'));
        }

        return view('documentos.show')->with('documento', $documento->all());
    }

    /**
     * Show the form for editing the specified documento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $documento = db::table('documento')->where('id',$id)->get();

        if (empty($documento)) {
            Flash::error('Documento not found');

            return redirect(route('documentos.index'));
        }

        return view('documentos.edit')->with('documento', $documento);
    }

    /**
     * Update the specified documento in storage.
     *
     * @param  int              $id
     * @param UpdatedocumentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedocumentoRequest $request)
    {
        $input=$request->all();
        $documento = db::table('documento')->where('id',$id)->get();

        if (empty($documento)) {
            Flash::error('Documento not found');

            return redirect(route('documentos.index'));
        }

        $documento = db::table('documento')->where('id',$id)->update(['titulo'=>$input['titulo'],'link'=>$input['link'],
      'fecha'=>$input['fecha'],'ubicacion'=>$input['ubicacion'],'contenido'=>$input['contenido']
      ]);

        Flash::success('Documento updated successfully.');

        return redirect(route('documentos.index'));
    }

    /**
     * Remove the specified documento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $documento = db::table('documento')->where('id',$id)->get();

        if (empty($documento)) {
            Flash::error('Documento not found');

            return redirect(route('documentos.index'));
        }

      db::table('documento')->where('id',$id)->delete();

        Flash::success('Documento deleted successfully.');

        return redirect(route('documentos.index'));
    }

    /*para generar las noticias */
    
    /*Funcion Principal llamada por el Daemon*/
    public  function start(){  
        //NOTICIAS  EL UNIVERSAL
       $link='http://www.eluniversal.com/sucesos/';
        $web='http://www.eluniversal.com/noticias/sucesos/';
        $getDate=1;
        $this->AnalizarHTML($link,$web,$getDate);
        
       //NOTICIAS SECUESTROS EL UNIVERSAL
     /*$link='http://www.eluniversal.com/localizador/secuestros';
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
       $this->AnalizarHTML($link,$web,1);*/
        
        //NOTICIAS SUCESOS EL NACIONAL
       /*$link='http://www.el-nacional.com/sucesos/';
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
        $this->AnalizarHTML($link,$web,$getDate);*/
        //////////////de aqui para arriba son las web que se analizan  del resto todo explota ! 
        
         //NOTICIAS sucesos elsiglo
    /*    $link='https://elsiglo.com.ve/internasucesos/';
        $web='https://elsiglo.com.ve/noticias-sucesos/';
        $getDate=5;
        $this->AnalizarHTML($link,$web,$getDate);*/
        //NOTICIAS sucesos elsiglo
        /*$link='https://www.el-carabobeno.com/secciones/noticias/sucesos/';
        $web='https://www.el-carabobeno.com/';
        $this->AnalizarHTML($link,$web,8);
        */
         /* $link='http://www.notitarde.com/sucesos/';
        $web='http://www.notitarde.com/';
        $this->AnalizarHTML($link,$web,9);*/
        
      /*$link='https://diariolavoz.net/sucesos/';
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
                            
                            echo 'LINKs --> '.$element->href.'<br>';
                            $pos = strpos($element-> href, $web);
                          
                            if($pos!==false){
                                
                                //busca la ubicacion del suceso
                                
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
}
