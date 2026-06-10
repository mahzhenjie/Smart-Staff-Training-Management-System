window.onload = function(){

    let staff =
        parseInt(
            document.getElementById("staffCount").innerText
        );

    let course =
        parseInt(
            document.getElementById("courseCount").innerText
        );

    let app =
        parseInt(
            document.getElementById("appCount").innerText
        );

    let att =
        parseInt(
            document.getElementById("attCount").innerText
        );

    animateValue("staffCount",0,staff,1000);
    animateValue("courseCount",0,course,1000);
    animateValue("appCount",0,app,1000);
    animateValue("attCount",0,att,1000);
};