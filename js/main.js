/*
    The showOrHide function accepts the class of divs to show or hide, changing the 
    classes of dropdown elements when necessary to correct border radius.
*/

function toggleMenu(subMenuClass, bottomElementID) {

  var elems = document.getElementsByTagName('*'),
    i;
  for (i in elems) {
    if ((' ' + elems[i].className + ' ').indexOf(' ' + subMenuClass + ' ') >
      -1) {

      if (elems[i].style.display === "none") {
        elems[i].style.display = "block";
        document.getElementById(bottomElementID).classList.remove("bottom-dropdown-item");
      } else {
        elems[i].style.display = "none";
        document.getElementById(bottomElementID).classList.add("bottom-dropdown-item");
      }
    }
  }
}