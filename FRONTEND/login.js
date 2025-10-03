document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;

  const user = JSON.parse(localStorage.getItem('registeredUser'));
  if (user && user.email === email) {
    localStorage.setItem('loggedInUser', JSON.stringify(user));
    window.location.href = 'dashboard.html';
  } else {
    document.getElementById('loginMessage').textContent = "Invalid credentials or user not registered.";
  }
});