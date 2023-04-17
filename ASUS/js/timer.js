var startingTime = document.getElementById('startingTime').value

if(localStorage.getItem("time")){
    var time = localStorage.getItem("time")
} else {
    var time = 60 * startingTime
}

function displayTime() {
    if(time < 0){
        localStorage.clear("time")
        window.location = "login.php"
    } else {
        let minutes = Math.floor(time / 60)
        let seconds = time % 60
        time -= 1
        if(minutes < 10){
            minutes = "0" + minutes
        } 
        if(seconds < 10){
            seconds = "0" + seconds
        }
        document.getElementById("remainingTime").innerHTML = "Time left: "+ minutes + ":" + seconds
        localStorage.setItem("time", time)
    }
}
setInterval(displayTime, 1000)