function highlight(id){
  var previous = $(".highlight").removeClass("highlight").css("background-color", "");

 var ele = $("#" + id);
 ele.addClass("highlight");
 ele.css("background-color", "yellow");

 document.getElementById("deleteId").setAttribute("value", id);
 console.log("Debug");

}

function removeEntry(){
  var id = $(".highlight").getAttribute("id");

}