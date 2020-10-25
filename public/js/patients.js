/**
 * Created by Mekki on 24/10/2020.
 */
viewPendingConsultation = function (consultation_id) {
    var url="/confirm_consultation/"+consultation_id;
    $.ajax({
        type: 'post',
        url: url,
        success: function (data) {
            $('.modal-title').html("Pending consultation");
            $('.modal-body').html(data);
            $('#consultationConfirmationModal').modal("show");
        }
    });
}

function emptySearchFields() {
    document.getElementById('patient_name').value="";
}