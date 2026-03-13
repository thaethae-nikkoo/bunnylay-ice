document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility
    const toggleOldPassword = document.getElementById('toggleOldPassword');
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    const oldPasswordField = document.getElementById('oldPassword');
    const newPasswordField = document.getElementById('newPassword');
    const confirmPasswordField = document.getElementById('confirmPassword');

    // Function to toggle password visibility
    function togglePasswordVisibility(inputField, iconElement) {
        if (inputField.type === "password") {
            inputField.type = "text";
            iconElement.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            inputField.type = "password";
            iconElement.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }

    // Event listeners for toggling
    toggleOldPassword.addEventListener('click', function () {
        togglePasswordVisibility(oldPasswordField, toggleOldPassword);
    });

    toggleNewPassword.addEventListener('click', function () {
        togglePasswordVisibility(newPasswordField, toggleNewPassword);
    });

    toggleConfirmPassword.addEventListener('click', function () {
        togglePasswordVisibility(confirmPasswordField, toggleConfirmPassword);
    });
});
