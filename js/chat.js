var initChat = function() {
    console.log("App is Offline.");
};

var Tawk_API;

if (navigator.onLine){
    console.log("Initializing Chat");
    initChat = function(){
        Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        var setUp = function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5e21598edaaca76c6fce77d8/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            console.log("Tawk.to set up");
        };
        setUp();
    };
}

initChat();