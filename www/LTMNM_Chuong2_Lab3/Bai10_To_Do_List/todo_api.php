<?php
$file = 'todo.json';
$todos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
if (!is_array($todos)) {
    $todos = [];
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $text = trim($_POST['text'] ?? '');
    if ($text !== '') {
        $todos[] = [
            'id' => time(),
            'text' => $text,
            'completed' => false
        ];
    }
}

if ($action === 'toggle') {
    $id = (int)($_POST['id'] ?? 0);
    foreach ($todos as &$todo) {
        if ($todo['id'] === $id) {
            $todo['completed'] = !$todo['completed'];
            break;
        }
    }
    unset($todo);
}

if ($action === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    $todos = array_values(array_filter($todos, fn($todo) => $todo['id'] !== $id));
}

if ($action !== '') {
    file_put_contents($file, json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

header('Content-Type: application/json');
echo json_encode($todos, JSON_UNESCAPED_UNICODE);
?>
