
    function hola() {
     document.getElementById("mapa").style.width = "100%";
 
     
    }
    
    function obtenerParada(e){
      
    $.get('/obtenerParadas/'+ e,function(response){
    console.log(response);
   
    if(response.length>0){
      
      
       // $.post( '/data/save', { name: 'Rebecca' }, function( resp ) {
       //  console.log( resp );
     // });
      
      
        
    }
    });
    
    
      
    }
    