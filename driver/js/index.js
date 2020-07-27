var url = new URL(window.location.href);
var type = url.searchParams.get("type");

clearErrorText()

function clearErrorText(){
    $("#login-empty-field").hide()
    $("#login-wrong-email-or-password").hide()
    $("#login-try-again").hide()
    $("#login-success-sign").hide()
    $("#login-not-driver").hide()
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

    fetch("/driver/php/login.php",{
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
            // setTimeout(function(){
            //     window.location.href = "./index.html"
            // }, 1000)
        } else {
            if(text === "email-not-found" || text === "wrong-password"){
                $("#login-wrong-email-or-password").show()
                return
            }
            else if(text === "null" || text === "token-update-fail"){
                $("#login-try-again").show()
                return
            }
            else if(text === "role-undefined" || text === "not-driver"){
                $("#login-not-driver").show()
            }
        }
    })
})