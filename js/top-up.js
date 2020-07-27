$(document).ready(function(){
    $('.collapsible').collapsible();
  });
  
  var topUpSection=document.getElementById("top-up-section")
  var inputTransaksiSection=document.getElementById("input-transaksi-section")
  var prosesTransaksiSection=document.getElementById("proses-transaksi-section")
  
  var url = new URL(window.location.href)
  var type = url.searchParams.get("type")
  
  $("#input-transaksi-section").hide()
  $("#proses-transaksi-section").hide()
  
  if(type == "top-up"){
    $("#top-up-section").hide()
    $("#input-transaksi-section").show()
  }

  var btnUpload=document.getElementById("btn-upload")
  btnUpload.onclick=(function(){
    $("#proses-transaksi-section").show()
})

$("#upload-image").click(function(){
    $("#file1").click();
});