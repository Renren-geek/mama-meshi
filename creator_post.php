<?php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mama') {
    header('Location: login.php');
    exit;
}

$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['age_group'])) {
        $stmt_user = $pdo->prepare("UPDATE users SET age_group = ? WHERE id = ?");
        $stmt_user->execute([$_POST['age_group'], $_SESSION['user_id']]);
    }

    $stmt = $pdo->prepare("INSERT INTO dishes (user_id, title, story_summary, story_detail, price, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $_POST['title'],
        $_POST['story_summary'],
        $_POST['story_detail'],
        $_POST['price'], 
        max(1, (int)$_POST['stock']) 
    ]);
    $success = "「料理」を投稿しました！運営の承認後に公開されます。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>手料理を出品 - ママめし</title>
</head>
<body class="bg-orange-50 min-h-screen pb-20">

    <div class="max-w-xl mx-auto p-6 md:p-12">
        <header class="flex justify-between items-center mb-10">
            <h1 class="text-2xl font-black text-orange-600 italic">ママめし Creator</h1>
            <a href="login.php" class="text-xs font-bold text-stone-400 hover:text-orange-500 underline">ログアウト</a>
        </header>

        <?php if($success): ?> 
            <div class="bg-white border-2 border-orange-200 p-6 rounded-[2rem] mb-10 text-orange-600 font-bold shadow-lg shadow-orange-100 italic text-center animate-bounce">
                <?= $success ?>
            </div> 
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-12 rounded-[3.5rem] shadow-2xl space-y-8 border border-orange-100">
            
            <div>
                <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">料理の写真を追加</label>
                <div class="w-full h-56 bg-stone-50 border-2 border-dashed border-stone-200 rounded-[2.5rem] flex flex-col items-center justify-center relative overflow-hidden group hover:border-orange-300 transition-all cursor-pointer">
                    <div class="text-center group-hover:scale-110 transition-transform">
                        <span class="text-5xl">📸</span>
                        <p class="text-[10px] font-black text-stone-400 mt-3 uppercase tracking-widest">Tap to upload</p>
                    </div>
                    <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">あなたの年代</label>
                <select name="age_group" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 font-bold appearance-none">
                    <option value="~30歳">~30歳</option>
                    <option value="30-40歳">30-40歳</option>
                    <option value="40-50歳">40-50歳</option>
                    <option value="50-60歳" selected>50-60歳</option>
                    <option value="60代〜ベテランママ">60代〜ベテランママ</option>
                </select>
            </div>

            <div>
                <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">料理の名前</label>
                <input type="text" name="title" required placeholder="例：特製肉じゃが" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 font-bold">
            </div>

            <div>
                <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">一言キャッチ</label>
                <input type="text" name="story_summary" placeholder="例：野菜嫌いの息子が完食した魔法のタレ" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">料理に込めた物語</label>
                <textarea name="story_detail" rows="5" placeholder="どんな想いで作りましたか？隠し味はありますか？" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 leading-relaxed"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">価格 (¥)</label>
                    <input type="number" name="price" required placeholder="850" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 font-black">
                </div>
                <div>
                    <label class="text-[10px] font-black text-stone-300 uppercase tracking-widest ml-2 mb-2 block">限定数 (食)</label>
                    <input type="number" name="stock" min="1" required placeholder="3" class="w-full p-5 bg-stone-50 rounded-2xl outline-none ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 font-black">
                </div>
            </div>

            <button type="submit" class="w-full bg-orange-500 text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-orange-200 active:scale-95 transition-all text-lg tracking-widest italic uppercase">
                手料理を出品する
            </button>
        </form>
    </div>

</body>
</html>