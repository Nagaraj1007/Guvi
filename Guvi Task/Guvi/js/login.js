function val(){
// Get sign up form details from local storage
var signUpData = localStorage.getItem("signup_data");
var signUpObj = JSON.parse(signUpData);

// Get form data entered by the user
var email = document.getElementById("email").value;
var password = document.getElementById("password").value;

// Validate form data against sign up form details
if (email === signUpObj.email && password === signUpObj.password) {
  // Login successful
  window.location.href = "profile.html";
  alert("Login Successful")
} else {
  // Login failed
  alert("Invalid email or password");
}
}
