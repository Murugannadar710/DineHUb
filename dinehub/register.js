document.addEventListener('DOMContentLoaded', function() {
    const showPasswordCheckbox = document.getElementById('showPasswordRegister');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
            confirmPasswordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
        }
    });

    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(registerForm);

        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Registration successful.")) {
                // Display success message and redirect after 2 seconds
                alert('Registration successful!');
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 2000);
            } else {
                // Display error message
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
