

export const setProperty = (state, details) => {
    state.property = details
}


export const removePropertyUser = (state, user) => {
    state.property.users.pop(user)
}
