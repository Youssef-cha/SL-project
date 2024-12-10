$(document).ready(function () {
  console.log($("[togglerFor]").each(function(index){
    $(this).click(function(){
        let elementClass = $(this).attr('togglerFor');
        let element = $('#' + elementClass);
        element.toggleClass('-translate-x-full')
        
    })
  }))
});
