/**
 * Created by Mekki on 01/11/2020.
 */

import './styles/doctor_schedule.css';

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
    document.getElementById("consultation_form_date_time_hour").value=hour;
}

window.fillDate=fillDate;
window.fillHour=fillHour;