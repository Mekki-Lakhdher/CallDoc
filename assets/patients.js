/**
 * Created by Mekki on 24/10/2020.
 */
import './styles/patients.css';

function viewPendingConsultation (consultation_id) {
    $('.modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
    var url="/confirm_consultation/"+consultation_id;
    $.ajax({
        type: 'post',
        url: url,
        success: function (data) {
            $('.modal-title').html("Consultation details");
            $('.modal-body').html(data);
            $('#consultationConfirmationModal').modal("show");
        }
    });
}

function emptySearchFields() {
    document.getElementById('patient_name').value="";
}

function emptyModalBody() {
    $('.modal-body').html('');
}

window.viewPendingConsultation=viewPendingConsultation;
window.emptySearchFields=emptySearchFields;
window.emptyModalBody=emptyModalBody;