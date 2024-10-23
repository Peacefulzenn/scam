document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting in the traditional way
        window.location.href = 'dashboard.html';  // Redirect to the dashboard page
    });
});
function viewDetails(doctorId) {
    // Here you would normally fetch data related to the specific doctor
    // For simplicity, we just display the modal with static data
    const modal = document.getElementById('patient-records-modal');
    modal.style.display = "block";
}

// Close the modal
document.querySelector('.close').onclick = function() {
    document.getElementById('patient-records-modal').style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('patient-records-modal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function viewDetails(patientId) {
    // Here you would normally fetch data related to the specific patient
    // For simplicity, we just display the modal with static data
    const modal = document.getElementById('patient-details-modal');
    modal.style.display = "block";
}

// Close the modal
document.querySelector('.close').onclick = function() {
    document.getElementById('patient-details-modal').style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    const modal = document.getElementById('patient-details-modal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
