<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_name'] = $user['name'];

        if ($user['role'] === 'mama') {
            header('Location: creator_post.php');
        } else {
            header('Location: index.php');
        }
        exit;
    }
    $error = "メールアドレスまたはパスワードが正しくありません。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ログイン - ママめし</title>
</head>
<body class="bg-orange-50 flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-sm bg-white p-8 rounded-[3rem] shadow-xl">
        <h1 class="text-3xl font-black text-orange-500 text-center mb-8 italic">ママめし</h1>
        <?php if(isset($error)): ?> <p class="text-red-500 text-xs mb-4 text-center"><?= $error ?></p> <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input type="email" name="email" placeholder="メールアドレス" required class="w-full p-4 bg-gray-50 rounded-2xl border-none ring-1 ring-gray-100 focus:ring-2 focus:ring-orange-500 outline-none">
            <input type="password" name="password" placeholder="パスワード" required class="w-full p-4 bg-gray-50 rounded-2xl border-none ring-1 ring-gray-100 focus:ring-2 focus:ring-orange-500 outline-none">
            <button class="w-full bg-orange-500 text-white font-black py-4 rounded-2xl shadow-lg active:scale-95 transition-all">ログイン</button>
        </form>
        <p class="mt-6 text-center text-xs text-gray-400">アカウント未登録の方は <a href="register.php" class="text-orange-500 underline">こちら</a></p>
    </div>
</body>
</html>