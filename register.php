<?php
require 'db.php';
session_start();

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $hashed_password,
            $_POST['role'] 
        ]);
        
        $msg = "登録が完了しました！ログインしてください。";
        header("Refresh: 2; url=login.php");
    } catch (PDOException $e) {
        $msg = "エラー: すでに登録されているメールアドレスか、入力に不備があります。";
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>新規登録 - ママめし</title>
</head>
<body class="bg-orange-50 flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md bg-white p-8 rounded-[3rem] shadow-xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-orange-500">ママめし</h1>
            <p class="text-stone-400 text-xs mt-2 font-bold uppercase tracking-widest">Join our story</p>
        </div>

        <?php if($msg): ?>
            <div class="bg-orange-100 text-orange-700 p-4 rounded-2xl mb-6 text-center text-sm font-bold border border-orange-200">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div class="flex gap-4 p-1 bg-stone-100 rounded-2xl">
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="role" value="user" checked class="hidden peer">
                    <div class="text-center py-3 rounded-xl peer-checked:bg-white peer-checked:text-orange-500 peer-checked:shadow-sm text-stone-400 font-bold text-sm transition-all">
                        食べる人
                    </div>
                </label>
                <label class="flex-1 cursor-pointer">
                    <input type="radio" name="role" value="mama" class="hidden peer">
                    <div class="text-center py-3 rounded-xl peer-checked:bg-white peer-checked:text-orange-500 peer-checked:shadow-sm text-stone-400 font-bold text-sm transition-all">
                        作るママ
                    </div>
                </label>
            </div>

            <div>
                <label class="block text-[10px] font-black text-stone-400 uppercase ml-2 mb-1">お名前</label>
                <input type="text" name="name" required placeholder="高梨 恵子" class="w-full p-4 bg-stone-50 rounded-2xl border-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black text-stone-400 uppercase ml-2 mb-1">メールアドレス</label>
                <input type="email" name="email" required placeholder="mama@example.com" class="w-full p-4 bg-stone-50 rounded-2xl border-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black text-stone-400 uppercase ml-2 mb-1">パスワード</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full p-4 bg-stone-50 rounded-2xl border-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
            </div>

            <button type="submit" class="w-full bg-stone-900 text-white font-black py-5 rounded-2xl shadow-xl active:scale-[0.98] transition-all mt-4">
                アカウントを作成する
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="login.php" class="text-xs text-orange-500 font-bold underline">すでにアカウントをお持ちの方はこちら</a>
        </div>
    </div>
</body>
</html>