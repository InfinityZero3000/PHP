<table border="1" id="rates"></table>
<script>
function loadRates() {
    fetch('rates.php')
        .then(res => res.json())
        .then(data => {
            let html = '<tr><th>Ngoại tệ</th><th>Mua vào</th><th>Bán ra</th></tr>';
            data.forEach(item => {
                html += `<tr><td>${item.currency}</td><td>${item.buy}</td><td>${item.sell}</td></tr>`;
            });
            document.getElementById('rates').innerHTML = html;
        });
}

setInterval(loadRates, 600000);
loadRates();
</script>
