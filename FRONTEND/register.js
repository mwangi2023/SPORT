document.getElementById('registerForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const full_name = document.getElementById('registerName').value;
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;

  fetch('../backend/register.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `full_name=${full_name}&email=${email}&password=${password}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // Store user info immediately
      const user = { name: full_name, email: email };
      localStorage.setItem('loggedInUser', JSON.stringify(user));

      // Redirect to dashboard
      window.location.href = 'dashboard.html';
    } else {
      document.getElementById('registerMessage').textContent = data.error || "Registration failed.";
    }
  });
});
