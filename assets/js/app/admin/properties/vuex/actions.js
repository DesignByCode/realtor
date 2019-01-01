

export const fetchProperty = ({ commit }, payload) => {
    return axios.get(`${appurl}/api/properties/${payload.id}`).then( (response) => {
        var data = response.data.data
        commit('setProperty', data)
    })
}

export const updateProperty = ({ commit }, payload ) => {
    return axios.patch(`${appurl}/api/${payload.url}/${payload.id}`, payload.form)
}

export const removeUserFromProperty = ( {state, commit} , payload ) => {
    return axios.delete(`${appurl}/api/remove_user/${payload.property}/${payload.user}`).then( (response) => {
        commit('removePropertyUser', payload.user)
    })
}
