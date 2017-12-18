<template>
  
  
       <gmap-map
          :center="center"
          :zoom="zoom"
          map-type-id="roadmap"
          style="width: 100%; height: 500px;"
      >
          <gmap-marker
              :key="index"
              v-for="(m, index) in markers"
              :position="m.position"
              :clickable="true"
            >
            <gmap-info-window  
              :position="m.position" >
               {{m.nombre}}
          </gmap-info-window>
          </gmap-marker>
        </gmap-map>

</template>

<script>
     export default {
        props:{
            center:Object,
            markers:Array,
            zoom:Number,
            
        },
        data () {
          return {
          }
        },
        
     
    }
</script>