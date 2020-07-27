(function($){
    $(function(){
      $('.sidenav').sidenav();
      $(".dropdown-trigger").dropdown();
    }); // end of document ready
  })(jQuery); // end of jQuery name space

  // needAuth(
  //   function(){}
  // );

  window.addEventListener('load', function() {
    window.history.pushState({ noBackExitsApp: true }, '')
  })
  
  window.addEventListener('popstate', function(event) {
    if (event.state && event.state.noBackExitsApp) {
      window.history.pushState({ noBackExitsApp: true }, '')
    }
  })

  document.getElementById("more-button-mobile").onclick=()=>{
    document.getElementById("navbar-more-popout").style.height = document.getElementById("navbar-more-popout").style.height==="0px"?"initial":"0px"
    document.getElementById("navbar-more-popout").style.padding = document.getElementById("navbar-more-popout").style.padding==="0rem"?"1rem":"0rem"
  }

  window.onclick = function(ev){
    if( ev.target.id !== 'more-button-mobile' && ev.target.parentNode.id!=='more-button-mobile'){
      document.getElementById("navbar-more-popout").style.height = "0px"
      document.getElementById("navbar-more-popout").style.padding = "0rem"
    }
};