// Register form validation
document.addEventListener('DOMContentLoaded', function() {
  const registerForm = document.getElementById('registerform');

  if (registerForm) {
    const registerButton = document.getElementById('registerbtn');
    const errorElement = document.getElementById('error');

    registerButton.addEventListener('click', (e) => {
      e.preventDefault();

      let messages = [];
      const fname = document.getElementById('fname');
      const lname = document.getElementById('lname');
      const remail = document.getElementById('remail');
      const rpassword = document.getElementById('rpassword');
      const repassword = document.getElementById('repassword');

     // Check if fname field is empty
      if (!fname.value) {
        messages.push('First name is required');
      } 
    
      // Check if fname length
      if (fname.value.length > 12) {
        messages.push('First name can\'t be longer than 12 characters');
      }

      if (!lname.value) {
        messages.push('Last name is required');
      }

      if (lname.value.length > 12) {
        messages.push('Last name can\'t be longer than 12 characters');
      }
           
      if (!remail.value) {
        messages.push('E-mail is required');
      } else {
        // Check if e-mail is valid
        let re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (!re.test(remail.value)) {
          messages.push('E-mail is not valid');
        }
      }

      if (!rpassword.value) {
        messages.push('Password is required');
      }

      // Check password length
      if (rpassword.value.length < 8) {
        messages.push('Password must contain at least 8 characters');
      }

      // Check if passwords match
      if (rpassword.value !== repassword.value) {
        messages.push("Passwords don't match");
      }
      
      // Display error message, else submit form
      if (messages.length > 0) {
        errorElement.innerText = messages.join(', ');
      } else {
        registerForm.submit();
      }
    });
  }
});

// Book form validation
document.addEventListener('DOMContentLoaded', function() {
  const bookForm = document.getElementById('bookform');
  
  if (bookForm) {
    const postButton = document.getElementById('postbook');
    const errorElement = document.getElementById('error');

    postButton.addEventListener('click', (e) => {
      e.preventDefault();

      let messages = [];
      const name = document.getElementById('name');
      const img = document.getElementById('img');
      const author = document.getElementById('author');
      const price = document.getElementById('price');
      const isbn = document.getElementById('isbn');
      const descri = document.getElementById('descri');

      // Check for empty fields
      if (!name.value) {
        messages.push('Book title is required');
      }

      if (name.value.length > 20) {
        messages.push('Book title can\'t be longer than 20 characters');
      }

      if (!img.value) {
        messages.push('Book cover image is required');
      }

      if (!author.value) {
        messages.push('Author is required');
      }

      if (author.value.length > 20) {
        messages.push('Author name can\'t be longer than 20 characters');
      }

      if (!price.value) {
        messages.push('Price is required');
      } else if (price.value < 0) {
        messages.push('Price can\'t be a negative number');
      }

      // ISBN must be 13 characters long
      if (!isbn.value) {
        messages.push('ISBN is required');
      } else if (isbn.value.length !== 13) {
        messages.push('ISBN must be 13 characters long');
      }

      if (!descri.value) {
        messages.push('Description is required');
      }
      
      if (descri.value.length > 500) {
        messages.push('Description can\'t be longer than 500 characters');
      }

      // Display error message, else submit form
      if (messages.length > 0) {
        errorElement.innerText = messages.join(', ');
      } else {
        bookForm.submit();
      }
    });
  }
});