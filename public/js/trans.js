$(document).ready(function(){
   $(document).bind('keydown keyup', function(e){
       if(e.keyCode===17) {
           $('.tKey, .tVal').toggleClass('hidden');
       }
   })
});