class AppStorage {
    
    getToken()
    {
        return localStorage.getItem('token')
    }
    
    getUser()
    {
        return localStorage.getItem('user')
    }

    store(token,user)
    {
        this.storeUser(user)
        this.storeToken(token)
    }

    storeUser(user){
        localStorage.setItem('user',user)
    }

    storeToken(token)
    {
        localStorage.setItem('token',token)
    }

    clear()
    {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }
}

export default AppStorage = new AppStorage()