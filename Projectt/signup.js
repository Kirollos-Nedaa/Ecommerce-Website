// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    
        form.classList.add('was-validated')
      }, false)



  document.getElementById('SignupForm').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const passwordMismatch = document.getElementById('passwordMismatch');
    const phoneNumber = document.getElementById('phnum').value;
    const phoneError = document.getElementById('phoneError');
    const phoneRegex = /^01\d{9}$/;

    if (password !== confirmPassword) {
        passwordMismatch.style.display = 'block';
    } else {
        passwordMismatch.style.display = 'none';
    }
    if (!phoneRegex.test(phoneNumber)) {
      phoneError.style.display = 'block';
      return false;
  } else {
      phoneError.style.display = 'none';
      return true;
  }
});



document.getElementById('phoneNumber').addEventListener('blur', validatePhoneNumber);

document.getElementById('signupForm').addEventListener('submit', function(event) {
    if (!validatePhoneNumber()) {
        event.preventDefault();
    }
});
