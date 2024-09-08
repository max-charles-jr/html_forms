document.getElementById('userForm').addEventListener('submit', function(e) {
  e.preventDefault();  // Prevent form submission from refreshing the page

  var formData = new FormData(this);

  // Add the 'ajax' flag to the form data
  formData.append('ajax', true);

  // Send the AJAX request
  fetch('', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      // Handle response and display feedback
      var feedback = document.getElementById('feedback');
      if (data.status === 'success') {
          feedback.innerHTML = '<div class="success">' + data.message + '</div>';
      } else {
          feedback.innerHTML = '<div class="error">' + data.message + '</div>';
      }
  })
  .catch(error => {
      console.error('Error:', error);
      document.getElementById('feedback').innerHTML = '<div class="error">An error occurred while submitting the form.</div>';
  });
});