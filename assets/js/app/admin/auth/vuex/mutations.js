import localforage from 'localforage';
import { isEmpty } from 'lodash';

export const setToken = (state, token) => {
    if (isEmpty(token)) {
        localforage.removeItem('authtoken', token)
        return
    }
    localforage.setItem('authtoken', token)
}

export const setAuthenticated = (state, data) => {
    // state.user.authenticated = data
}

export const setUserData = (state, data) => {
    state.user = data
}


export const addPhoneNumber = (state, data) => {
    state.user.phones.push(data.form)
}
