/**
 * Created by Mekki on 01/11/2020.
 */

import './styles/doctor_schedule.css';

document.getElementById('description_field').onkeyup = function(){
    document.getElementById("description_length").innerHTML=this.value.length;
    document.getElementById("consultation_form_description").value=this.value;
}

$(document).ready(function(){

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        startDate: '0d'
    });

    $('.cell').click(function(){
        $('.cell').removeClass('select');
        $(this).addClass('select');
    });

});

document.getElementById("consultation_form_date_date_month").value=3;

function fillDate (date_object) {

    // Get date
    var str = date_object.value;
    var res = str.split("-");
    var day=parseInt(res[0]);
    var mounth=parseInt(res[1]);
    var year=parseInt(res[2]);

    // Set date
    document.getElementById("consultation_form_date_date_day").value=day;
    document.getElementById("consultation_form_date_date_month").value=mounth;
    document.getElementById("consultation_form_date_date_year").value=year;

}

function fillHour (hour) {
    addSelectedHourButtonBorder('btn_'+hour);
    document.getElementById("consultation_form_date_time_hour").value=hour;
}

function addSelectedHourButtonBorder (id) {
    // Remove non selected buttons border
    var i;
    for (i = 8; i <= 16; i++) {
        if (i === 12) {continue;}
        document.getElementById("btn_"+i).style.border="";
        document.getElementById("btn_"+i).style.zIndex = 0;
    }
    // Add border to the selected button
    document.getElementById(id).style.borderWidth="1px";
    document.getElementById(id).style.borderColor="black";
    // Make button on top of other buttons
    document.getElementById(id).style.zIndex = 1;
}

window.fillDate=fillDate;
window.fillHour=fillHour;