$(function(){
  var curDown = false,
      curYPos = 0,
      curXPos = 0;
  $(" #LISTA ").mousemove(function(m){
    if(curDown === true){

    // $( this ).scrollLeft($(this).scrollLeft() + (curXPos - m.pageX));
    $( this ).scrollLeft((curXPos - m.pageX));
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