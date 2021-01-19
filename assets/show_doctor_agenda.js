/**
 * Created by Mekki on 01/11/2020.
 */

const routes = require('../public/js/fos_js_routes.json');
import Routing from '../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.js';
import './styles/show_doctor_agenda.css';
Routing.setRoutingData(routes);

function viewDoctorConsultation(consultation_id) {
    return Routing.generate('view_doctor_consultation', { consultation_id: consultation_id });
}

window.viewDoctorConsultation=viewDoctorConsultation;