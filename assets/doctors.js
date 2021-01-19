/**
 * Created by Mekki on 22/10/2020.
 */

import './styles/doctors.css';

console.log("Doctors");

function viewDoctorSchedule(doctor_id,doctor_first_name,doctor_last_name) {
    let url="/doctor_schedule/"+doctor_id;
    $.ajax({
        type: 'post',
        url: url,
        success: function (data) {
            $('.modal-title').html("Ask "+doctor_first_name+" "+doctor_last_name+" for a consultation");
            $('.modal-body').html(data);
            $('#doctorSceduleModal').modal("show");
        }
    });
}

function emptySearchFields() {
    document.getElementById('doctor_name').value="";
    document.getElementById('doctor_speciality').value="";
}

function showConsultationButton(doctor_id) {
    document.getElementById('consultation_'+doctor_id).style.display="inline";
}

function hideConsultationButton(doctor_id) {
    document.getElementById('consultation_'+doctor_id).style.display="none";
}

window.showConsultationButton=showConsultationButton;
window.hideConsultationButton=hideConsultationButton;
window.emptySearchFields=emptySearchFields;
window.viewDoctorSchedule=viewDoctorSchedule;