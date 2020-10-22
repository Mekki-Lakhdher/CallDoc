/**
 * Created by Mekki on 04/10/2020.
 */
window.onload=function() {
    loadView('home_page_content')
};

function loadView(view) {

    var xmlhttp = new XMLHttpRequest(),
        method = 'POST',
        url = 'https://localhost:8000/'+view;

    xmlhttp.open(method, url, true);
    xmlhttp.onprogress = function (e) {
        console.log("Loaded : "+event.loaded+" From total : "+e.total);
    };
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $('#main_administration_tab').html(this.responseText);
        }
    };

}