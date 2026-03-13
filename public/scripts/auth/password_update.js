document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

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
    toggleNewPassword.addEventListener('click', function () {
        togglePasswordVisibility(newPasswordField, toggleNewPassword);
    });

    toggleConfirmPassword.addEventListener('click', function () {
        togglePasswordVisibility(confirmPasswordField, toggleConfirmPassword);
    });


     const forgetPassPageUrl = window.appData.forgetPassPageUrl;
    // console.log("Redirection URL: " + forgetPassPageUrl);

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    const userCredential = getCookie('userCredential');

    if (userCredential) {
        try {
            const decoded = atob(userCredential); // Base64 decode
            const userData = JSON.parse(decoded); // JSON parse

            if (userData && userData.username) {
                document.getElementById('userIdFromCookie').value = userData.username;
            } else {
                console.log('Redirecting due to missing or invalid username in cookie');
                window.location.href = forgetPassPageUrl;
            }
        } catch (error) {
            console.warn('Invalid JSON in cookie', error);
            window.location.href = forgetPassPageUrl;
        }
    } else {
        console.warn('Cookie "userCredential" not found');
        window.location.href = forgetPassPageUrl;
    }
});
