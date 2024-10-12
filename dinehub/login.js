document.addEventListener('DOMContentLoaded', function() {
    const showPasswordCheckbox = document.getElementById('showPasswordLogin');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });

    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username === '' || password === '') {
            alert('Please fill out all fields.');
            return;
        }

        const formData = new FormData(loginForm);

        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'Login successful') {
                // Display success message and redirect after a short delay
                alert('Login successful!');
                setTimeout(() => {
                    window.location.href = 'modules/home.html';
                }, 1000); // 1 second delay for the alert
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
