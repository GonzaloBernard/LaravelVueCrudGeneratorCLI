<template>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">remove_red_eye</i>
              </div>
              <h4 class="card-title">
                {{ $t('global.view') }}
                <strong>entity_name</strong>
              </h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <div class="table">
                      <tbody>
                        <tr>
                          <td class="text-primary">#</td>
                          <td>{{ entry.id }}</td>
                        </tr>
                        <!-- SHOW TABLE VUE -->
                      </tbody>
                    </div>
                  </div>
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
  import DatatableList from '@components/Datatables/DatatableList'
  
  export default {
    components: {
      DatatableList
    },
    data() {
      return {}
    },
    beforeDestroy() {
      this.resetState()
    },
    computed: {
      ...mapGetters('entity_nameSingle', ['entry'])
    },
    watch: {
      '$route.params.id': {
        immediate: true,
        handler() {
          this.resetState()
          this.fetchShowData(this.$route.params.id)
        }
      }
    },
    methods: {
      ...mapActions('entity_nameSingle', ['fetchShowData', 'resetState'])
    }
  }
</script>
  