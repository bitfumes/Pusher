let token = null
let username = null

import Token from './token'
import AppStorage from './storage'
class Auth {

    login(data)
    {
        axios.post('/api/login',data)
        .then(res => this.respondAfterLogin(res))
    }

    respondAfterLogin(res)
    {
        token = res.data.access_token
        username = res.data.user
        if(Token.isValid(token)){
            AppStorage.store(token,username)
            window.location = '/forum'
        }
    }
    
    hasToken()
    {
        var storedToken = AppStorage.getToken()
        if(storedToken){
            if(Token.isValid(storedToken)){
                return true; 
            }
        }
        return false;
    }
    
    logout(){
        AppStorage.clear()
        window.location = '/login'
    }
    
    loggedIn()
    {
        return this.hasToken();
    }
    
    user()
    {
        if(this.loggedIn()){
            return AppStorage.getUser()
        }
    }
    
    userId()
    {
        if(this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken())
            return payload.sub
        }
    }
    
    redirect(url)
    {
        window.location = url
    }
    
    owns(contentUserId){
        return this.userId() == contentUserId
    }
}


export default Auth = new Auth()