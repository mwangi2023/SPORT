document.getElementById('loginForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;

  fetch('../backend/login.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `email=${email}&password=${password}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      localStorage.setItem('loggedInUser', JSON.stringify(data.user));
      window.location.href = 'dashboard.html';
    } else {
      document.getElementById('loginMessage').textContent = data.error || "Login failed.";
    }
  });
});