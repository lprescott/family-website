/*
    The showContent function accepts the name of a class to change and the class name to change it to as params.
        It does so by looping througoh all elements, referencing their classnames and then changing matches.
*/

function showContent(matchClass, content) {
    var elems = document.getElementsByTagName('*'), i;
    for (i in elems) {
        if((' ' + elems[i].className + ' ').indexOf(' ' + matchClass + ' ')
                > -1) {
            elems[i].className = content;
        }
    }
}