var mapSection=document.getElementById("map-section")
var inputLocationSection=document.getElementById("input-location")
var pembayaranSection=document.getElementById("pembayaran-section")
var changePembayaranSection=document.getElementById("change-pembayaran-section")
var loadingPembayaranSection=document.getElementById("loading-screen-section")

var url = new URL(window.location.href)
var type = url.searchParams.get("type")

$("#pembayaran-section").hide()
$("#change-pembayaran-section").hide()
$("#loading-screen-section").hide()

if(type == "pembayaran"){
    $("#input-location").hide()
    $("#pembayaran-section").show()
}

if(type == "order"){
    $("#input-location").hide()
    $("#map-section").hide()
    $("#loading-screen-section").show()
}

var btnChangePembayaran=document.getElementById("btn-change-pembayaran")

btnChangePembayaran.onclick=(function(){
    $("#change-pembayaran-section").show()
})

var btnClose=document.getElementById("btn-close")

btnClose.onclick=(function(){
    $("#change-pembayaran-section").hide()
})

window.onclick = function(ev){
    if( ev.target.id !== 'btn-change-pembayaran'){
        $("#change-pembayaran-section").hide()
        document.getElementById("change-pembayaran-section").style.width = "0px"
        document.getElementById("change-pembayaran-section").style.padding = "0rem"
    }
};
