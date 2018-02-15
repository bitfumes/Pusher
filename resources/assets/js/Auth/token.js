class Token {

    isValid(token){
        const payload = this.payload(token)
        if(payload){
            return payload.iss = "https://pusher.dev/api/login" || "https://pusher.dev/api/signUp"? true : false
        }
        return false
    }

    payload(token){
        const payload = token.split('.')[1]
        return this.decode(payload)
    }

    decode(payload){
        if(this.isBase64(payload))
        {
            return JSON.parse(atob(payload));
        }
        return false
    }

    isBase64(str) {
        try {
            return btoa(atob(str)).replace(/=/g,"") == str;
        } catch (err) {
            return false;
        }
    }

    userId(token){
        this.payload(token)
    }
}

export default Token = new Token();