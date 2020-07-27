if (window.location.pathname === "/"||window.location.pathname === "/index.html"){
    $("#home-button-mobile .navbar-bottom-button-icon").addClass("navbar-button-selected");
    $("#home-button-mobile .navbar-bottom-button-text").addClass("navbar-button-selected");
    $(".navbar-top").addClass("hidden");
} else {
    $(".content").addClass("topbar-tolerance");
    $(".navbar-top-title").html(details[window.location.pathname].title);
    if (details[window.location.pathname].bottom){
        $("#"+details[window.location.pathname].bottomId+" .navbar-bottom-button-icon").addClass("navbar-button-selected");
        $("#"+details[window.location.pathname].bottomId+" .navbar-bottom-button-text").addClass("navbar-button-selected");
    }
}