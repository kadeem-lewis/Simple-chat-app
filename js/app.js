function showLoginModal() {
  let loginBtn = document.querySelector(".login");
  let loginForm = document.getElementById("login-form");

  loginBtn.addEventListener("click", () => {
    loginForm.style.display = "block";
  });
}
function hideLoginModal() {
  let closeLoginBtn = document.querySelector(".close-login");
  let loginForm = document.getElementById("login-form");

  closeLoginBtn.addEventListener("click", () => {
    loginForm.style.display = "none";
  });
}

function submitLogin() {}
