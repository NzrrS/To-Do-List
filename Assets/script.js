

const Email = document.getElementById("email");
const form = document.querySelector("form");
const Password = document.getElementById("psw");
const PasswordConfirm = document.getElementById("psw2");
const eyeicon1 = document.getElementById("eyeicon1");
const eyeicon2 = document.getElementById("eyeicon2");
const userName = document.getElementById("userName")



eyeicon1.onclick = function () {
  if (Password.type === "password") {
    Password.type = "text";
    eyeicon1.className = "fa-solid fa-eye";
  } else {
    Password.type = "password";
    eyeicon1.className = "fa-solid fa-eye-slash";
  }
};

eyeicon2.onclick = function () {
  if (PasswordConfirm.type === "password") {
    PasswordConfirm.type = "text";
    eyeicon2.className = "fa-solid fa-eye";
  } else {
    PasswordConfirm.type = "password";
    eyeicon2.className = "fa-solid fa-eye-slash";
  }
};


