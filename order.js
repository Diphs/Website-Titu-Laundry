function opsiMenu(evt, opsi) {
    var i, activity, option;

    activity = document.getElementsByClassName("activity");
    for (i = 0; i < activity.length; i++) {
        activity[i].style.display = "none";
    }

    option = document.getElementsByClassName("option");
    for (i = 0; i < option.length; i++) {
        option[i].className = option[i].className.replace(" active", "");
    }

    document.getElementById(opsi).style.display = "block";
    evt.currentTarget.className += " active";
}