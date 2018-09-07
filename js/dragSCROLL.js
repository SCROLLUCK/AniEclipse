$(function(){
  var curDown = false,
      curYPos = 0,
      curXPos = 0;
  $(" #LISTA ").mousemove(function(m){
    if(curDown === true){

    $( this ).scrollLeft(  ($(this).scrollLeft() + (curXPos - m.pageX))*0.4 );
    }
  });
  
  $(" #LISTA ").mousedown(function(m){
    curDown = true;
    curXPos = m.pageX;
  });
  
  $(" #LISTA ").mouseup(function(){
    curDown = false;
  });
})