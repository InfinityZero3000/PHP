<form id="registerForm">
    <input type="text" id="username" placeholder="Tên đăng nhập"><br>
    <input type="text" id="email" placeholder="Email"><br>
    <input type="password" id="password" placeholder="Mật khẩu"><br>
    <button type="submit">Đăng ký</button>
</form>
<p id="msg"></p>
<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let username = document.getElementById('username').value.trim();
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value;
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (username === '' || !regex.test(email) || password.length < 6) {
        document.getElementById('msg').innerText = 'Dữ liệu không hợp lệ';
        return;
    }

    let formData = new FormData();
    formData.append('username', username);
    formData.append('email', email);
    formData.append('password', password);

    fetch('register.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(data => document.getElementById('msg').innerText = data);
});
</script>
