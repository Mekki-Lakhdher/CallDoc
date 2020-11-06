/**
 * Created by Mekki on 01/11/2020.
 */
import './styles/consultation_confirmation.css';

document.getElementById("consultation_form_confirm").onclick = function () {
    document.getElementById("consultation_form_confirmed").value=1;
    document.getElementById("consultation_form_canceled").value=0;
}

document.getElementById("consultation_form_cancel").onclick = function () {
    document.getElementById("consultation_form_canceled").value=1;
    document.getElementById("consultation_form_confirmed").value=0;
}

function saveDemand (confirmed) {

    if (!confirmed) {
        document.getElementById("").value=1;
    }
}

window.saveDemand=saveDemand;