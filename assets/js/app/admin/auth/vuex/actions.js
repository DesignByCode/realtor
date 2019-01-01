import { isEmpty } from 'lodash';
import { setHttpToken } from '../../../../helpers';
import localforage from 'localforage';

export const register = ({ dispatch }, { payload, context }) => {
    return axios.post('/api/auth/register', payload).then( (response) => {
        dispatch('setToken', response.data.meta.token).then( () => {
            dispatch('fetchUser')
        })
    }).catch( (error) => {
        context.errors = error.response.data.errors
        toastr.error(error.response.data.message)
    })
}


export const login = ({ dispatch, commit }, { payload, context }) => {
    return axios.post('/api/auth/login', payload).then( (response) => {
        dispatch('setToken', response.data.meta.token).then( () => {
            dispatch('fetchUser')
        })
    }).catch( (error) => {
        context.errors = error.response.data.errors
        toastr.error(error.response.data.message)
    })
}

export const logout = ({ dispatch }) => {
    return axios.post('/api/auth/logout').then( () => {
        dispatch('clearAuth')
    })
}

export const fetchUser = ({ commit }) => {
    return axios.get('/api/auth/me').then( (response) => {
        commit('setAuthenticated', true)
        commit('setUserData', response.data.data)
    })
}

export const setToken = ({ commit, dispatch }, token) => {
    if (isEmpty(token)) {
        return dispatch('checkTokenExists').then( (token) => {
            setHttpToken(token)
        })
    }
    commit('setToken', token)
    setHttpToken(token)
}

export const checkTokenExists = () => {
    return localforage.getItem('authtoken').then( (token) => {
        if (isEmpty(token)) {
            return Promise.reject('NO_STORAGE_TOKEN')
        }
        return Promise.resolve(token)
    })
}

export const clearAuth = ({ commit }, token) => {
    commit('setUserData', null)
    commit('setAuthenticated', false)
    commit('setToken', null)
    setHttpToken(null)
}



/// User

export const updateUserProfile = ( {state, commit, dispatch},  payload  ) => {
    return axios.patch(`${appurl}/api/profile/${state.user.id}`, payload.form).then( (response) => {
        commit('setUserData', response.data.data)
        dispatch('fetchUser')
    })
}

export const updateUserProfilePassword = ( {state, commit, dispatch},  payload  ) => {
    return axios.post(`${appurl}/api/password`, payload.form).then( (response) => {
        commit('setUserData', response.data.data)
        dispatch('fetchUser')
    })
}

// Phone

export const addPhone = ( {state, commit, dispatch} , payload ) => {
    return axios.post(`${appurl}/api/phones`, payload.form).then( (response) => {
        commit('addPhoneNumber', payload)
        dispatch('fetchUser')
    })
}

export const removePhone = ( {state, dispatch} , payload ) => {
    return axios.delete(`${appurl}/api/phones/${payload.id}`).then( (response) => {
        dispatch('fetchUser')
    })
}
