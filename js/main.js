/*
    The showOrHide function accepts the class of divs to show or hide, changing the 
    classes of dropdown elements when necessary to correct border radius.
*/

function toggleMenu(subMenuClass, bottomElementID, menuID) {

  var elems = document.getElementsByTagName('*'),
    i;
  for (i in elems) {
    if ((' ' + elems[i].className + ' ').indexOf(' ' + subMenuClass + ' ') >
      -1) {

      if (elems[i].style.display === "none") {
        
        elems[i].style.display = "block";
        document.getElementById(bottomElementID).classList.remove("bottom-dropdown-item");
        
        var MenuItem = document.getElementById(menuID);
        MenuItem.classList.remove("fa-angle-down");
        MenuItem.classList.add("fa-angle-up");
      } else {

        elems[i].style.display = "none";
        document.getElementById(bottomElementID).classList.add("bottom-dropdown-item");
        
        var MenuItem = document.getElementById(menuID);
        MenuItem.classList.remove("fa-angle-up");
        MenuItem.classList.add("fa-angle-down");
      }
    }
  }
}

/*
  The changeCaret functions flips the caret of any meny on mouse over.
*/
function changeCaret(menuID, boolOver){

  if(boolOver == 1){
    var MenuItem = document.getElementById(menuID);
    MenuItem.classList.remove("fa-angle-down");
    MenuItem.classList.add("fa-angle-up");
  } else{
    var MenuItem = document.getElementById(menuID);
    MenuItem.classList.remove("fa-angle-up");
    MenuItem.classList.add("fa-angle-down");
  }
}