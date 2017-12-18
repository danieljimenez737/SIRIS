<template>
  <v-app id="inspire">
       <!-- <v-navigation-drawer
      persistent
      clipped
      app
      v-model="drawer"
    >
      
             <v-select class="mt-2 ml-2"
              v-model="tipo"
              prepend-icon="list"
              label="Tipo de suceso"
              multiple
              tags
              :items="items"
            ></v-select>
                <v-select
              v-model="ubicacion"
              prepend-icon="place"
              label=" Ubicación"
              class="ml-2"
              
              :items="items2"
            ></v-select>
            <v-btn block color="blue" dark v-on:click="filtro">Buscar</v-btn>
            <v-btn block color="blue" dark v-on:click="reset">Limpiar</v-btn>
  
    </v-navigation-drawer>-->
    <v-toolbar
      color="blue darken-1"
      dark
      app
      clipped-left
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <!--<v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>-->
         Siris
      </v-toolbar-title>
      <!--<v-text-field
        light
        solo
        prepend-icon="search"
        placeholder="Búscar noticias"
        style="max-width: 500px; min-width: 128px"
        v-model="buscarNtoicia"
      ></v-text-field>-->
      <v-spacer></v-spacer>
      <v-btn icon large v-on:click='generarMarcas'>
        <v-avatar size="32px" tile>
          <img
            src="https://vuetifyjs.com/static/doc-images/logo.svg"
            alt="Vuetify"
          >
        </v-avatar>
      </v-btn>
    </v-toolbar>
    <main>
      <v-content>
        <v-container fluid grid-list-md>
          <v-layout row wrap justify-center align-center>
            <!--CRITERIO DE BUSQUDA-->
             <v-flex xs class="pt-2 mt-2"  >
                <v-card  color="white lighten-2" class="black--text" >
                  <v-card-title >  
                    <!--Buscar noticias de sucesos-->
                  <!--<img src="panel.png">&nbsp;&nbsp;&nbsp;-->
                   <v-subheader><b1>Búscar:</b1></v-subheader> 
                     <v-text-field  
                        class="white--text"
                        placeholder=" "
                        single-line
                        required
                        primary
                        :append-icon-cb="() => {}"
                        v-model = "search"
                        v-on:keyup.enter.native="filtro()">
                     </v-text-field>
                        <v-btn icon light   class="icono4"  v-on:click.native="filtro()" >
                          <v-icon >search</v-icon>
                        </v-btn> </span>
                  </v-card-title>
                </v-card>    
              </v-flex>
              <!--SELECT ONE MENU UBICACION-->
              <!--<v-flex xs6 class="pt-2 mt-2"  >
                <v-card  color="white lighten-2" class="black--text" >
                  <v-card-title >  
                    <v-subheader><b1>Filtrar:</b1></v-subheader> 
                      <v-select
                          v-model="ubicacion"
                          prepend-icon="place"
                          label=" Ubicación"
                          class="ml-2"
                          :items="items2"
                          v-on:keyup.enter.native="filtro()">
                      ></v-select>
                      <v-btn icon light   class="icono4"  v-on:click.native="filtro()" >
                      <v-icon >search</v-icon>
                    </v-btn> </span>
                  </v-card-title>
                </v-card>    
              </v-flex>-->
              
             <v-flex xs12 class="black--text" >
                  <div id="map"></div>
                    <mapa id="mapa" v-bind:center.sync="center" v-bind:markers.sync="markers" :zoom="zoom" ></mapa>
               </v-flex>
               <v-flex xs12 class="black--text" >
                 <v-flex xs12 class="black--text" >
                <v-card color="white lighten-2" class="black--text" >
                   <v-card-title ><img src="">&nbsp;&nbsp;&nbsp;
                     <h6>Sucesos </h6>
                   </v-card-title>
                </v-card>    
              </v-flex>
                    <test :items='items3'></test>
               </v-flex>
          </v-layout>
        </v-container>
      </v-content>
    </main>
    </v-btn>
      <v-snackbar
        :timeout="timeout"
        top
        v-model="snackbar"
      >
      {{ text }}
      <v-btn flat color="pink" @click.native="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-app>
</template>

<script>
import * as VueGoogleMaps from 'vue2-google-maps';

  export default {
    data: () => ({
      //varibales del proyecto
       center: {lat: 10.4686988, lng:-67.030451}, 
        markers:[],
        zoom:10,
        search:'',
       tipo:[],
      ubicacion:[],
        currentLocation : { lat : 0, lng : 0},
         markers:[],
         ubicaciones:[],
         buscarNtoicia:'',
      //////
      timeout:6000,
      snackbar:false,
      text:'',
      drawer: true,
      item: [
        { icon: 'search', text: 'Tipo de sucesos', },
     
      ],
      items:['Robo','Asesinato','secuestro','otros'],
      items2:[],
      items3:[],
    }),
    props: {
      source: String
    },
    created() {
      var i;
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.get('api/getLocations').then((response)=>{
              console.log(response.data.data)
              for (var propiedad in response.data.data){
                this.items2.push(response.data.data[propiedad]);
              	console.log(propiedad);
              	console.log(response.data.data[propiedad]);
              }
              //this.items2=response.data.data
            }).catch((error)=>{
              console.log(error)
            });
      
    },
    
    methods:{
      getNewsByType(aux){
        alert(aux)
      },
      generarMarcas(){
         this.markers=[];
          axios.get('api/getLocations2').then((response)=>{
           
            if(response.data.message=='200'){
                var i;
                var geocoder = new google.maps.Geocoder();
                this.ubicaciones=response.data.data
                
                for(i=0;i<response.data.data.length;i++){
                  
                    geocoder.geocode({'address': 'Caracas,Venezuela '+  this.ubicaciones[i]}, (results, status) => {
                    
                      if (status === 'OK') {
                          this.currentLocation.lat = results[0].geometry.location.lat();
                          this.currentLocation.lng = results[0].geometry.location.lng();
                          var position={position:{lat:  this.currentLocation.lat, lng: this.currentLocation.lng },nombre:results[0].address_components[0].short_name};
                         // this.markers=[];
                          this.markers.push(position);
                          this.zoom=12;
                      }
                    });
                }
              
            }
          }).catch((error)=>{
            console.log(error);
          });
        
      },
      reset(){
        
        //this.center: {lat: 10.4686988, lng:-67.030451}, 
        //this.markers:[],
        //this.zoom:10,
        //this.search:'',
        this.tipo=[];
        this.ubicacion=[];
        this.items3=[];
        //this.currentLocation : { lat : 0, lng : 0},
         //this.markers:[],
         //this.ubicaciones:[],
      },
      
      filtro(){
          this.drawer=false;
           if( this.search==''){
             this.snackbar=true;
             this.text="debe completar los filtros para buscar";
           }else{
             var search={
               string:this.search,
               
             };
            
            axios.post('api/filtrar',search).then((response)=>{
              
                  var geocoder = new google.maps.Geocoder();
                  this.markers=[];
                  var i;
                    console.log(response.data.data.length);
                    this.items3=[];
                for(i=0;i<response.data.data.length;i++){
                       this.items3.push(response.data.data[i][0]);
                        geocoder.geocode({'address': 'Venezuela '+  response.data.data[i][0].ubicacion}, (results, status) => {
                        
                          if (status === 'OK') {
                              this.currentLocation.lat = results[0].geometry.location.lat();
                              this.currentLocation.lng = results[0].geometry.location.lng();
                              var position={position:{lat:  this.currentLocation.lat, lng: this.currentLocation.lng },nombre:results[0].address_components[0].short_name};
                             
                              this.markers.push(position);
                              this.zoom=12;
                          }
                        });
                    }
                  console.log(this.items3);
            }).catch((error)=>{
              console.log(error);
            });
             
           }
       
      }
  }}
</script>