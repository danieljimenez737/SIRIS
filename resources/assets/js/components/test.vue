<template>
  
  <v-card>
    <v-card-title>
      Sucesos
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        label="Search"
        single-line
        hide-details
        v-model="search"
      ></v-text-field>
    </v-card-title>
    <v-data-table
       v-bind:headers="headers"
      v-bind:items="items"
      v-bind:search="search"
      v-bind:pagination.sync="pagination"
      hide-actions
      class="elevation-1"
      >
      <template slot="items" slot-scope="props">
        <td>
          <v-edit-dialog
            lazy
          >   {{ props.item.titulo }}
            <v-text-field
              slot="input"
              label="Edit"
              v-model="props.item.ubicacion"
              single-line
              counter
              :rules="[max25chars]"
            ></v-text-field>
          </v-edit-dialog>
        </td>
       <td class="text-xs-right">{{ props.item.titulo }}</td>
        <td  class="text-xs-right">{{ props.item.link }}</td>
        <td  class="text-xs-right">{{ props.item.ubicacion }}</td>
        <td class="text-xs-right">
          <v-edit-dialog
            @open="tmp = props.item.iron"
            @save="props.item.iron = tmp || props.item.iron"
            large
            lazy
          >
            <div>{{ props.item.iron }}</div>
            <div slot="input" class="mt-3 title">Update Iron</div>
            <v-text-field
              slot="input"
              label="Edit"
              v-model="tmp"
              single-line
              counter
              autofocus
              :rules="[max25chars]"
            ></v-text-field>
          </v-edit-dialog>
        </td>
      </template>
    </v-data-table>
    <div class="text-xs-center pt-2">
      <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
    </div>
  </v-card>
  
  
  
  
  
    <!--<div>
    <v-data-table
      v-bind:headers="headers"
      v-bind:items="items"
      v-bind:search="search"
      v-bind:pagination.sync="pagination"
      hide-actions
      class="elevation-1"
    >
      <template slot="headerCell" slot-scope="props">
        <v-tooltip bottom>
          <span slot="activator">
            {{ props.header.text }}
          </span>
          <span>
            {{ props.header.text }}
          </span>
        </v-tooltip>
      </template>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.titulo }}</td>
        <td  class="text-xs-right">{{ props.item.link }}</td>
        <td  class="text-xs-right">{{ props.item.ubicacion }}</td>
      </template>
    </v-data-table>
    <div class="text-xs-center pt-2">
      <v-pagination v-model="pagination.page" :length="pages"></v-pagination>
    </div>
  </div>-->
</template>

<script>
  export default {
    data () {
      return {
        max25chars: (v) => v.length <= 25 || 'Input too long!',
         tmp: '',
        search: '',
        pagination: {},
        selected: [],
        headers: [
          {
            text: 'Titulo',
            align: 'left',
            sortable: false,
            value: 'name'
          },
          { text: 'Link',sortable: false, },
          { text: 'Ubicación',sortable: false, },
        
        ],
      }
    },
    props:{
       items:Array,
    },
    computed: {
      pages () {
        return this.pagination.rowsPerPage ? Math.ceil(this.items.length /this.pagination.rowsPerPage) : 0
      }
    }
  }
</script>