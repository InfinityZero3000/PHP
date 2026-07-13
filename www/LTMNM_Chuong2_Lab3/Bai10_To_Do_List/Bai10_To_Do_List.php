<input type="text" id="task" placeholder="Nhập công việc">
<button onclick="addTodo()">Thêm</button>
<ul id="list"></ul>
<script>
function loadTodos() {
    fetch('todo_api.php')
        .then(res => res.json())
        .then(data => {
            document.getElementById('list').innerHTML = data.map(todo =>
                `<li>
                    <input type="checkbox" ${todo.completed ? 'checked' : ''}
                           onchange="toggleTodo(${todo.id})">
                    <span style="text-decoration: ${todo.completed ? 'line-through' : 'none'}">
                        ${todo.text}
                    </span>
                    <button onclick="deleteTodo(${todo.id})">Xóa</button>
                </li>`
            ).join('');
        });
}

function sendAction(data) {
    let formData = new FormData();
    Object.keys(data).forEach(key => formData.append(key, data[key]));
    fetch('todo_api.php', { method: 'POST', body: formData })
        .then(() => loadTodos());
}

function addTodo() {
    sendAction({ action: 'add', text: document.getElementById('task').value });
    document.getElementById('task').value = '';
}

function toggleTodo(id) {
    sendAction({ action: 'toggle', id: id });
}

function deleteTodo(id) {
    sendAction({ action: 'delete', id: id });
}

loadTodos();
</script>
