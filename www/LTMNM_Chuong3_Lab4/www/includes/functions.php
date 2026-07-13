<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function setFlash(string $type, string $message): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function pullFlash(): ?array
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) ? $flash : null;
}

function csrfToken(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrf(?string $token): bool
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function validateStudentInput(array $input): array
{
    $name = trim((string) ($input['name'] ?? ''));
    $email = trim((string) ($input['email'] ?? ''));
    $phone = trim((string) ($input['phone'] ?? ''));
    $birthday = trim((string) ($input['birthday'] ?? ''));

    $errors = [];

    if ($name === '') {
        $errors['name'] = 'Họ tên không được để trống.';
    } elseif (mb_strlen($name) > 100) {
        $errors['name'] = 'Họ tên tối đa 100 ký tự.';
    }

    if ($email === '') {
        $errors['email'] = 'Email không được để trống.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không đúng định dạng.';
    } elseif (mb_strlen($email) > 100) {
        $errors['email'] = 'Email tối đa 100 ký tự.';
    }

    if ($phone !== '' && !preg_match('/^[0-9+()\-\s]{8,20}$/', $phone)) {
        $errors['phone'] = 'Số điện thoại chỉ gồm số và các ký tự + ( ) -.';
    }

    if ($birthday !== '') {
        $date = DateTime::createFromFormat('Y-m-d', $birthday);
        if (!$date || $date->format('Y-m-d') !== $birthday) {
            $errors['birthday'] = 'Ngày sinh không hợp lệ.';
        }
    }

    return [
        'data' => [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'birthday' => $birthday,
        ],
        'errors' => $errors,
    ];
}
