let firstname = document.getElementById('firstname')
let middleInitial = document.getElementById('middleInitial')
let lastname = document.getElementById('lastname')
let username = document.getElementById('username')
let password1 = document.getElementById('PassEntry')
let confirmPassword = document.getElementById('confirmPassword')
let address = document.getElementById('address')
let loginbtn = document.getElementById('loginbtn')
let signupbtn = document.getElementById('signupbtn')

signupbtn.addEventListener('click', kungEClickSiSignupBtn)

function illegalChar(text){
    let len = text.length
    for (let i = 0; i<len; i++){
        if(text[i]>='a'&& text[i]<='z' || text[i]>='A'&& text[i]<='Z'){
            continue
        } else if (text[i]>='0'&& text[i]>='9'){
            continue
        } else if (text[i]>='ñ'&& text[i]>='Ñ'){
            continue
        } else if (text[i]>=',' || text[i] == '@'){
            continue
        } else {
            return true
        }
    }
    return false
}

function nameStringChecker(text){
    let len = text.length
    for (let i = 0; i<len; i++){
        if(text[i]==' ' || text[i] == '-' || text[i]>='a'&& text[i]<='z' || text[i]>='A'&& text[i]<='Z'){
            continue
        } else {
            return true
        }
    }
    return false
}

function kungEClickSiSignupBtn(paraDeleMoReload){
    
    document.getElementById("notifierSaUsername").innerHTML = ""; 
    document.getElementById("notifierSaPassword").innerHTML = "";
    document.getElementById("notifierSaUsername").innerHTML = "";
    document.getElementById("notifierSaFname").innerHTML = "";
    document.getElementById("notifierSaMname").innerHTML = ""; 
    document.getElementById("notifierSaLname").innerHTML = ""; 
    document.getElementById("notifierSaPassword").innerHTML = "";

    let lens = username.value.length
    if(nameStringChecker(firstname.value) == true ){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaFname").innerHTML = "Letters only";
        return
    } 
    if (nameStringChecker(middleInitial.value) == true ){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaMname").innerHTML = "Letters only"; 
        return
    } 
    if (nameStringChecker(lastname.value) == true){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaLname").innerHTML = "Letters only"; 
        return
    }
    if(illegalChar(username.value) == true){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaUsername").innerHTML = "Letters and number only";
        return
    } 
    if(lens < 8 || lens > 20){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaUsername").innerHTML = "8 upto 20 characters only";
        return
    } 
    if(StrengthChecker(password1.value)){
        paraDeleMoReload.preventDefault(); 
        document.getElementById('StrengthDisp').innerHTML = "Weak password";
        document.getElementById('StrengthDisp').style.color = "green";
        return
    }
    if(password1.value != confirmPassword.value){
        paraDeleMoReload.preventDefault();
        document.getElementById("notifierSaPassword").innerHTML = "Password doesn't match";
        return
    }
}
