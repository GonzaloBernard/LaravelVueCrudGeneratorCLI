<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon"><i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">
                            {{ $t('global.table') }}
                            <strong>entity_name</strong>
                        </h4>
                    </div>

                    <div class="card-body">
                        <router-link class="btn btn-primary" :to="{ name: 'name_camelcase.create' }">
                            <i class="material-icons">
                                add
                            </i>
                            {{ $t('global.add') }}
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <v-data-table
                                    :headers="headers"
                                    :items="data"
                                    :search="search"
                                >
                                    <template v-slot:[`item.acciones`]="{ item }">
                                        <div class="d-flex justify-content-center">
                                        <v-tooltip bottom color="primary">
                                            <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                @click="editItem(item.id)"
                                                class="mx-1"
                                                fab
                                                dark
                                                x-small
                                                v-bind="attrs"
                                                v-on="on"
                                                color="primary"
                                                ><v-icon dark>mdi-pencil</v-icon></v-btn
                                            >
                                            </template>
                                            <span>Editar</span>
                                        </v-tooltip>
                                        <v-tooltip top color="error">
                                            <template v-slot:activator="{ on, attrs }">
                                            <v-btn
                                                @click="destroyDataAction(item.id)"
                                                class="mx-1"
                                                fab
                                                dark
                                                x-small
                                                v-bind="attrs"
                                                v-on="on"
                                                color="red darken-3"
                                                ><v-icon dark>mdi-delete-forever</v-icon>
                                            </v-btn>
                                            </template>
                                            <span>Borrar</span>
                                        </v-tooltip>
                                        </div>
                                    </template>
                                </v-data-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  components: {
  },
  data() {
    return {
        search: "",
        headers: [
            { text: "#", value: "id" },
            // INDEX TABLE VUE
            { text: "Acciones", value: "acciones" , align: "center"},
        ],
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  created(){
    //console.log("asd")
    this.fetchIndexData()
  },
  computed: {
    ...mapGetters('entity_nameIndex', ['data', 'total', 'loading'])
  },
  methods: {
    ...mapActions('entity_nameIndex', ['fetchIndexData', 'resetState'])
  }
}
</script>
