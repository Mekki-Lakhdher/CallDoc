import './styles/view_patient_consultation.css';

function joinChatRoom(consultation_id) {
    window.open('http://localhost:3000/'+consultation_id, '_blank');
}

window.joinChatRoom=joinChatRoom;