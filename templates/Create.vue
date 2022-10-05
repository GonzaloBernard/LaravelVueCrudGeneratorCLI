<template>
    <div class="container-fluid">
      <form @submit.prevent="submitForm">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">add</i>
                </div>
                <h4 class="card-title">
                  {{ $t('global.create') }}
                  <strong>Crear entity_name</strong>
                </h4>
              </div>
              <div class="card-body">
                <back-button></back-button>
              </div>
              <div class="card-body">
                <!--# <bootstrap-alert /> -->
                <div class="row">
                  <div class="col-md-12">
                      <!-- ACA VAN TODOS LOS INPUTS -->
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <vue-button-spinner
                  class="btn-primary"
                  :status="status"
                  :isLoading="loading"
                  :disabled="loading"
                >
                  {{ $t('global.save') }}
                </vue-button-spinner>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</template>
<script>
  import { mapGetters, mapActions } from 'vuex'
  
  export default {
    data() {
      return {
        status: '',
        activeField: ''
      }
    },
    computed: {
      ...mapGetters('entity_nameSingle', ['entry', 'loading', 'lists'])
    },
    mounted() {
      this.fetchCreateData()
    },
    beforeDestroy() {
      this.resetState()
    },
    methods: {
      ...mapActions('entity_nameSingle', [
        'fetchCreateData',
        'storeData',
        'resetState',
        // MAP ACTIONS
      ]),
  
      submitForm() {
        this.storeData()
          .then(() => {
            this.$router.push({ name: 'name_camelcase.index' })
            this.$eventHub.$emit('create-success')
          })
          .catch(error => {
            this.status = 'failed'
            _.delay(() => {
              this.status = ''
            }, 3000)
          })
      },
      focusField(name) {
        this.activeField = name
      },
      clearFocus() {
        this.activeField = ''
      }
    }
  }
  </script>
  