/**
 * Created by Mekki on 22/10/2020.
 */

/*window.onload = function() {
    viewDoctorsList();
};

function viewDoctorsList(doctor_name, speciality_name) {
    let dataTosend=
        'doctor_name='+doctor_name
        +'&speciality_name='+speciality_name;
    let url="/doctors_list";
    $.ajax({
        type: 'post',
        data:dataTosend,
        url: url,
        success: function (data) {
            $('#doctors_list').html(data);
        }
    });
}*/

function viewDoctorSchedule(doctor_id,doctor_first_name,doctor_last_name) {

    let url="/doctor_schedule/"+doctor_id;
    $.ajax({
        type: 'post',
        url: url,
        success: function (data) {
            $('.modal-title').html("Schedule of doctor "+doctor_first_name+" "+doctor_last_name);
            $('.modal-body').html(data);
            $('#doctorSceduleModal').modal("show");
        }
    });
}