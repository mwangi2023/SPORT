document.getElementById('registerForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const full_name = document.getElementById('registerName').value;
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;

  if (password !== confirmPassword) {
    document.getElementById('registerMessage').textContent = "Passwords do not match.";
    return;
  }

  fetch('../backend/register.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `fullName=${encodeURIComponent(full_name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      localStorage.setItem('loggedInUser', JSON.stringify({ name: full_name, email }));
      window.location.href = 'dashboard.html';
    } else {
      document.getElementById('registerMessage').textContent = data.error || "Registration failed.";
    }
  })
  .catch(err => {
    document.getElementById('registerMessage').textContent = "Server error. Please try again.";
    console.error("Fetch error:", err);
  });
});