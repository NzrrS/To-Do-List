const Email = document.getElementById("email");
const Password = document.getElementById("password");
const form = document.querySelector("form");
const eyeicon = document.getElementById("eyeicon");
eyeicon.className = "fa-solid fa-eye-slash";

// Initialize eye icon class based on password input type
if (Password.type === "password") {
  eyeicon.className = "fa-solid fa-eye-slash";
} else {
  eyeicon.className = "fa-solid fa-eye";
}

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
  if (!emailRegex.test(Email.value)) {
    alert("Email is incorrect, please use a valid email");
  }
  if (Password.value === "" || Password.value.length < 8) {
    alert("Password should be at least 8 characters.");
  }
});
eyeicon.onclick = function () {
  eyeicon.className = "fa-solid fa-eye-slash";
  if (Password.type == "password") {
    Password.type = "text";
    eyeicon.className = "fa-solid fa-eye";
  } else if (Password.type == "text") {
    Password.type = "password";
    eyeicon.className = "fa-solid fa-eye-slash";
  }
};
