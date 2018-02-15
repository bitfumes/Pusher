import Alert from './Alert'
window.Alert = Alert
class Exception {
    handle(err){
        this.tokenExpired(err)
    }

    tokenExpired(err){
        if(err.error === 'Token is Expired'){
            Alert.error(err.error);
            Auth.logout()
        }
    }
}

export default Exception = new Exception();