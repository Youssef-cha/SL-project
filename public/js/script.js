// select
document.addEventListener("DOMContentLoaded", function () {
  var selects = document.querySelectorAll(".inputBx select");


  selects.forEach(function (select) {
    filled (select)
    select.addEventListener("change", function(){filled(select)});
  });





  function filled(select) {
    if (select.value !== "") {
      select.classList.add("filled");
    } else {
      select.classList.remove("filled");
    }
  }















  // radio
  const oui = document.getElementById("GARANTIEoui");
  const non = document.getElementById("GARANTIEnon");
  const dropped = document.querySelector(".dropped");
  oui.addEventListener("change", dropper);
  non.addEventListener("change", dropper);
  dropper();

  function dropper() {
    if (oui.checked) {
      dropped.classList.add("show");
    } else {
      dropped.classList.remove("show");
    }
  }
});
