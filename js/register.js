document.addEventListener("DOMContentLoaded", function () {
  // Get the form element by its ID
  const form = document.getElementById("registerForm");

  // Get the message div element to display feedback
  const messageDiv = document.getElementById("registerMessage");

  // Add an event listener for the form submission
  form.addEventListener("submit", function (e) {
    // Prevent the default form submission behavior (page reload)
    e.preventDefault();

    // Clear any previous messages
    messageDiv.style.display = "none";
    messageDiv.textContent = "";

    // Perform a fetch request to send form data to the server
    fetch(form.action, {
      method: "POST",
      body: new FormData(form),
    })
      .then((response) => {
        // Throw an error if the response is not OK
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        // Parse the response as JSON
        return response.json();
      })
      .then((data) => {
        // If the registration is successful
        if (data.success) {
          // Display a success message
          messageDiv.style.display = "block";
          messageDiv.style.color = "green";
          messageDiv.textContent = "Registration successful!";

          // Redirect to the login page after a delay
          setTimeout(() => {
            window.location.href = "/login";
          }, 2000);
        } else {
          // Display error messages
          messageDiv.style.display = "block";
          messageDiv.style.color = "red";
          messageDiv.innerHTML = data.errors.join("<br>");
        }
      })
      .catch((error) => {
        // Log the error to the console
        console.error("Error:", error);

        // Display a generic error message
        messageDiv.style.display = "block";
        messageDiv.style.color = "red";
        messageDiv.textContent = "An unexpected error occurred. Please try again.";
      });
  });
});