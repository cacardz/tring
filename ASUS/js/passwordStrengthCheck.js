// timeout before a callback is called

let timeout;

// traversing the DOM and getting the input and span using their IDs

let password = document.getElementById('PassEntry')
let strengthBadge = document.getElementById('StrengthDisp')

// The strong and weak password Regex pattern checker

let strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})')
let mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))')

function StrengthChecker(PasswordParameter){
    // We then change the badge's color and text based on the password strength
     
    if(strongPassword.test(PasswordParameter)) {
        document.querySelector("#PassEntry").style.borderColor = "green";
        document.getElementById('password_container').title = "Strong password";
        strengthBadge.style.color = "green"
        strengthBadge.textContent = 'Strong password'
    } else if(mediumPassword.test(PasswordParameter)){
        document.querySelector("#PassEntry").style.borderColor = "blue";
        document.getElementById('password_container').title = "Good password."
        strengthBadge.style.color = "blue"
        strengthBadge.textContent = 'Good password'
    } else{
        document.querySelector("#PassEntry").style.borderColor = "red";
        document.getElementById('password_container').title = "Weak password";
        strengthBadge.style.color = "red"
        strengthBadge.textContent = 'Weak password'
        return true;
    }
    return false;
}

// Adding an input event listener when a user types to the  password input 

password.addEventListener("input", () => {

    //The badge is hidden by default, so we show it

    strengthBadge.style.display= 'block'
    clearTimeout(timeout);

    //We then call the StrengChecker function as a callback then pass the typed password to it

    timeout = setTimeout(() => StrengthChecker(password.value), 500);

    //Incase a user clears the text, the badge is hidden again

    if(password.value.length !== 0){
        strengthBadge.style.display != 'block'
    } else{
        strengthBadge.style.display = 'none'
    }
});
