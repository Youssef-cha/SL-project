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


  // confirmation supp
  function confirmDeletion() {
    return confirm("Êtes-vous sûr de vouloir supprimer ce fournisseur ?"); 
}

// menu

// function toggleMenu() {
//   var menu = document.querySelector('.menu');
//   var content = document.querySelector('.content');
//   var toggleButton = document.getElementById('menu-toggle');

//   menu.classList.toggle('hidden');
//   content.classList.toggle('menu-hidden');
//   content.classList.toggle('menu-visible');

//   if (menu.classList.contains('hidden')) {
//       toggleButton.innerHTML = '<i class="fa-solid fa-arrow-right"></i>';  
//   } else {
//       toggleButton.innerHTML = '<i class="fa-solid fa-arrow-left"></i>';  
//   }
// }
// Définir la fonction toggleMenu avant d'attacher l'événement
function toggleMenu() {
  var menu = document.querySelector('.menu');
  var content = document.querySelector('.content');
  var toggleButton = document.getElementById('menu-toggle');

  menu.classList.toggle('hidden');
  content.classList.toggle('menu-hidden');
  content.classList.toggle('menu-visible');

  if (menu.classList.contains('hidden')) {
      toggleButton.innerHTML = '<i class="fa-solid fa-arrow-right"></i>';
  } else {
      toggleButton.innerHTML = '<i class="fa-solid fa-arrow-left"></i>';
  }
}


window.onload = function() {
  var toggleButton = document.getElementById('menu-toggle');
  if (toggleButton) {
      toggleButton.addEventListener('click', toggleMenu);
  } else {
      console.log("L'élément #menu-toggle n'a pas été trouvé.");
  }
};



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
 //confirm del 
 function confirmDelete() {
 
    var result = confirm("Voulez-vous vraiment supprimer ce complexe ?");


    return result;
}
