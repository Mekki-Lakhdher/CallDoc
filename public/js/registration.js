/**
 * Created by Mekki on 30/09/2020.
 */

/**
 * Specialities autocomplete.
 */
var specialists=[];
var url="/doctors/specialities";
$.ajax({
    type: 'post',
    url: url,
    success: function (data) {
        jQuery.each(data, function(i, specialities_objects) {
            jQuery.each(specialities_objects, function(j, speciality_object) {
                var spec=Object.values(speciality_object)[1];
                specialists.push(spec);
            });
        });
        $(function() {
            $( "#registration_form_speciality" ).autocomplete({
                source: specialists,
            });
        });
    }
});

// Disable 'speciality' field
$('#registration_form_speciality').attr('disabled','disabled');
// Set 'birth_date' field width
/*document.getElementById('registration_form_birth_date_day').style.width='33%';
document.getElementById('registration_form_birth_date_month').style.width='33%';
document.getElementById('registration_form_birth_date_year').style.width='34%';*/
// Set 'roles' field value
var role=$('#registration_form_role');
role.change( function() {
    var role_object=document.getElementById('registration_form_role');
    document.getElementById('registration_form_roles').value=role_object.value;
    // Show / hide 'speciality' field
    if (role_object.value=='ROLE_DOCTOR') {
        // Enable the 'speciality' field input
        $('#registration_form_speciality').removeAttr('disabled');
    }
    else {
        // Disable & empty the 'speciality' field input
        $('#registration_form_speciality').attr('disabled','disabled');
        document.getElementById('registration_form_speciality').value='';
    }
});