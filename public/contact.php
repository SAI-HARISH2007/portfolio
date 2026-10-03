<?php
/* Contact endpoint. Accepts a normal form POST or JSON, replies with JSON when
   asked for it, otherwise redirects back to the page with a status flag. */

header('X-Content-Type-Options: nosniff');
$wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function respond(bool $ok, string $text, bool $json): never {
    if ($json) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['ok' => $ok, 'message' => $text]);
    } else {
        header('Location: ./?sent=' . ($ok ? '1' : '0') . '#contact', true, 303);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./#contact', true, 303);
    exit;
}

$in = $_POST;
if (empty($in)) {
    $decoded = json_decode(file_get_contents('php://input'), true);
    if (is_array($decoded)) $in = $decoded;
}

$name    = trim((string)($in['name'] ?? ''));
$email   = trim((string)($in['email'] ?? ''));
$message = trim((string)($in['message'] ?? ''));
$trap    = trim((string)($in['website'] ?? ''));   // honeypot, hidden from people

if ($trap !== '') respond(true, 'Sent.', $wantsJson);
if ($name === '' || $email === '' || $message === '')
    respond(false, 'Name, email and message are all needed.', $wantsJson);
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    respond(false, 'That email address does not look valid.', $wantsJson);
if (mb_strlen($message) > 5000)
    respond(false, 'Keep the message under 5000 characters.', $wantsJson);

$clean   = fn(string $s) => preg_replace('/[\r\n]+/', ' ', $s);
$to      = 'saiharishanand2007@gmail.com';
$subject = 'Portfolio contact from ' . $clean($name);
$body    = "From: {$clean($name)} <{$clean($email)}>\n\n{$message}\n";
$headers = "From: noreply@acadnet.net\r\n"
         . "Reply-To: {$clean($email)}\r\n"
         . "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = @mail($to, $subject, $body, $headers);
respond(
    $ok,
    $ok ? 'Sent. I usually reply within a couple of days.'
        : 'Could not send. Email me directly at saiharishanand2007@gmail.com.',
    $wantsJson
);
