$("#signup").hide()

var url = new URL(window.location.href);
var type = url.searchParams.get("type");

if(type==="signup"){
    $("#login").hide()
    $("#signup").show()
}

var signupButton = document.getElementById("signup-button")
var acceptTOS = document.getElementById("tos-check")
acceptTOS.checked = false
acceptTOS.addEventListener('change', event =>{
    if(event.target.checked){
        signupButton.classList.remove("disabled")
    }else{
        signupButton.classList.add("disabled")
    }
})

clearErrorText()

function clearErrorText(){
    $("#signup-pass-doesnt-match").hide()
    $("#signup-need-verification").hide()
    $("#signup-registered").hide()
    $("#signup-signup-failed").hide()
    $("#signup-success-sign").hide()
    $("#signup-empty-field").hide()
    $("#login-empty-field").hide()
    $("#login-wrong-email-or-password").hide()
    $("#login-try-again").hide()
    $("#login-success-sign").hide()
}


function tryParseJSON (jsonString){
    try {
        var o = JSON.parse(jsonString);
        if (o && typeof o === "object") {
            return o;
        }
    }
    catch (e) { }

    return false;
};

$("#login-button").click(function(){
    event.preventDefault()
    clearErrorText()

    var loginEmptyError = document.getElementById("login-empty-field")

    if($("#login-email").val() === "" || $("#login-email").val() === null || $("#login-email").val() === undefined){
        loginEmptyError.innerHTML = '<div class="error-text">Email cannot be empty</div>'
        $("#login-empty-field").show()
        return
    }
    else if($("#login-password").val() === "" || $("#login-password").val() === null || $("#login-password").val() === undefined){
        loginEmptyError.innerHTML = '<div class="error-text">Password cannot be empty</div>'
        $("#login-empty-field").show()
        return
    }

    const data = new URLSearchParams()
    data.append("email", $("#login-email").val())
    data.append("password", $("#login-password").val())

    fetch("/php/auth.php",{
        method : 'post',
        body: data
    })
    .then(function(response){
        return response.text()
    })
    .then(function(text){
        console.log(text)

        if (tryParseJSON(text)){
            localStorage.setItem("userdata", data);
            $("#login-success-sign").show().delay(3000).hide(1);
            setTimeout(function(){
                window.location.href = "./index.html"
            }, 1000)
        } else {
            if(text === "email-not-found" || text === "wrong-password"){
                $("#login-wrong-email-or-password").show()
                return
            }
            else if(text === "null" || text === "token-update-fail"){
                $("login-try-again").show()
                return
            }
        }
    })
})

$("#signup-button").click(function(){
    event.preventDefault()
    clearErrorText()

    var signupEmptyError = document.getElementById("signup-empty-field")

    if($("#signup-name").val() === "" || $("#signup-name").val() === null || $("#signup-name").val() === undefined){
        signupEmptyError.innerHTML = '<div class="error-text">Name cannot be empty</div>'
        $("#signup-empty-field").show()
        return
    }
    else if($("#signup-email").val() === "" || $("#signup-email").val() === null || $("#signup-email").val() === undefined){
        signupEmptyError.innerHTML = '<div class="error-text">Email cannot be empty</div>'
        $("#signup-empty-field").show()
        return
    }
    else if($("#signup-password").val() === "" || $("#signup-password").val() === null || $("#signup-password").val() === undefined){
        signupEmptyError.innerHTML = '<div class="error-text">Password cannot be empty</div>'
        $("#signup-empty-field").show()
        return
    }
    else if($("#signup-confirm-password").val() === "" || $("#signup-confirm-password").val() === null || $("#signup-confirm-password").val() === undefined){
        signupEmptyError.innerHTML = '<div class="error-text">Confirm Password cannot be empty</div>'
        $("#signup-empty-field").show()
        return
    }
    else if($("#signup-phone-number").val() === "" || $("#signup-phone-number").val() === null || $("#signup-phone-number").val() === undefined){
        signupEmptyError.innerHTML = '<div class="error-text">Phone Number cannot be empty</div>'
        $("#signup-empty-field").show()
        return
    }
    else if($("#signup-password").val() !== $("#signup-confirm-password").val()){
        $("#signup-pass-doesnt-match").show()
        return
    }

    const data = new URLSearchParams()
    data.append("name", $("#signup-name").val())
    data.append("email", $("#signup-email").val())
    data.append("password", $("#signup-password").val())
    data.append("phone", $("#signup-phone-number").val())

    fetch("/php/register.php",{
        method : 'post',
        body: data
    })
    .then(function(response){
        return response.text()
    })
    .then(function(text){
        console.log(text)
        if(text === "failed" || text === "email-not-found" || text === "insert-failure" || text === "removal-failure" || text === "user-initialization-failure" || text === "user-creation-failure"){
            console.log(" Gagal ")
            $("#signup-signup-failed").show()
        }
        else if(text === "email-registered"){
            console.log(" Registered ")
            $("#signup-registered").show()
        }
        else if(text === "email-found"){
            console.log(" Verifikasi Dulu ")
            $("#signup-need-verification").show()
        }
        else if(text === "success"){
            $("#signup-success-sign").show().delay(3000).hide(1);
            setTimeout(function(){
                window.location.href = "./authentication.html"
            }, 1000)
        }
    })
})