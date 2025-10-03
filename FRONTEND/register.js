document.getElementById('registerForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const name = document.getElementById('registerName').value;
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;

  // Save mock user data
  localStorage.setItem('registeredUser', JSON.stringify({ name, email }));
  window.location.href = 'login.html';
});