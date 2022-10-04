const set = key => (state, val) => {
    state[key] = val
  }
  
  function initialState() {
    return {
      data: [],
      total: 0,
      loading: false
    }
  }
  
  const route = 'name_camelcase'
  
  const getters = {
    data: state => state.data,
    total: state => state.total,
    loading: state => state.loading
  }
  
  const actions = {
    fetchIndexData({ commit/* , state */ }) {
      commit('setLoading', true)
      axios
        .get(route/* , { params: state.query } */)
        .then(response => {
          commit('setData', response.data.data)
          //commit('setTotal', response.data.total)
        })
        .catch(error => {
          message = error.response.data.message || error.message
          console.log("Error fetchIndexData:")
          console.log(message)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    },
    destroyData({ commit, state, dispatch }, id) {
      axios
        .delete(`${route}/${id}`)
        .then(response => {
          dispatch('fetchIndexData')
        })
        .catch(error => {
          message = error.response.data.message || error.message
          console.log("Error destroyData:")
          console.log(message)
        })
    },
  
    resetState({ commit }) {
      commit('resetState')
    }
  }
  
  const mutations = {
    setData: set('data'),
    setTotal: set('total'),
    setLoading: set('loading'),
    resetState(state) {
      Object.assign(state, initialState())
    }
  }
  
  export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
  }
  