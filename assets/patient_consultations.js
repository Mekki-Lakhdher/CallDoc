/**
 * Created by Mekki on 16/11/2020.
 */

function emptySearchFields() {
    document.getElementById('doctor_name').value="";
}

function showConsultationButton(consultation_id) {
    document.getElementById('consultation_'+consultation_id).style.display="inline-block";
}

function hideConsultationButton(consultation_id) {
    document.getElementById('consultation_'+consultation_id).style.display="none";
}

window.showConsultationButton=showConsultationButton;
window.hideConsultationButton=hideConsultationButton;

window.emptySearchFields=emptySearchFields;