$(document).ready(function () {
  // side bar
  $("[togglerFor]").each(function (index) {
    $(this).click(function () {
      let elementClass = $(this).attr("togglerFor");
      let element = $("#" + elementClass);
      element.toggleClass("-translate-x-full");
    });
  });
  // disable input
  disableInput();
  $("#garantie").click(disableInput);
  function disableInput() {
    if ($("#garantie").prop("checked")) {
      $("#retenue").prop("disabled", false);
    } else {
      $("#retenue").prop("disabled", true);
    }
  }
  // close success card
  $(".closeButton").each(function (element) {
    $(this).click(() => $("#successModal").remove());
  });

  // three dots menu

  // Event delegation for dynamically loaded buttons
  $(document).on("click", ".dropdown-button", function (e) {
    e.stopPropagation(); // Prevent the event from bubbling up

    // Get the matching dropdown menu by ID
    var dropdownID = $(this).attr("id").replace("-button", ""); // Extract the ID
    var $menu = $("#" + dropdownID);

    // Hide all other dropdowns and toggle the clicked one
    $(".dropdown-menu").not($menu).addClass("hidden");
    $menu.toggleClass("hidden");
  });

  // Close dropdowns when clicking outside
  $(document).on("click", function () {
    $(".dropdown-menu").addClass("hidden");
  });
});
