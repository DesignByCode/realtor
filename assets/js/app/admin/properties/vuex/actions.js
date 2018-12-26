

export const fetchProperty = ({ commit }, payload) => {
    return axios.get(`${appurl}/api/properties/${payload.id}`).then( (response) => {
        var data = response.data.data
        commit('setProperty', data)
    })
}



export const updateProperty = ({ commit }, payload ) => {
    return axios.patch(`${appurl}/api/${payload.url}/${payload.id}`, payload.form)
}
