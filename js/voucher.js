$(document).ready(function(){
  $('.collapsible').collapsible();
});


var voucherSection=document.getElementById("voucher-section")

var url = new URL(window.location.href)
var type = url.searchParams.get("type")

$("#map-section").hide()
$("#input-location").hide()
$("#pembayaran-section").hide()
$("#change-pembayaran-section").hide()
$("#loading-screen-section").hide()

if(type == "voucher"){
  $("#voucher-section").show()
}