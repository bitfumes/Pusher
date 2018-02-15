class Alert {
    error(message){
        Vue.toasted.show(message,{ 
            type: "error",
            position: "top-center", 
            duration : 5000,
            fitToScreen:true
        })
    }

    success(message){
        Vue.toasted.show(message,{ 
            type: "success",
            position: "top-center", 
            duration : 5000,
            fitToScreen:true
        })
    }
}
export default Alert = new Alert();