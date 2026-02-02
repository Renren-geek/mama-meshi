<?php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
}

if (isset($_POST['approve_id'])) {
    $stmt = $pdo->prepare("UPDATE dishes SET status = 'approved' WHERE id = ?");
    $stmt->execute([$_POST['approve_id']]);
}

$pending_dishes = $pdo->query("SELECT d.*, u.name as mama_name FROM dishes d JOIN users u ON d.user_id = u.id WHERE d.status = 'pending' ORDER BY d.created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><script src="https://cdn.tailwindcss.com"></script><title>管理画面 - ママめし</title></head>
<body class="bg-slate-900 text-slate-100 p-8 font-mono">
    <h1 class="text-2xl font-black text-orange-500 mb-10 underline">ママめし承認画面</h1>
    <div class="space-y-4">
        <?php foreach($pending_dishes as $dish): ?>
        <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 flex justify-between items-center">
            <div>
                <p class="text-[10px] text-orange-400">作り手: <?= htmlspecialchars($dish['mama_name']) ?></p>
                <h3 class="text-lg font-bold"><?= htmlspecialchars($dish['title']) ?></h3>
                <p class="text-slate-400 text-xs mt-1 italic"><?= htmlspecialchars($dish['story_summary']) ?></p>
            </div>
            <form method="POST">
                <input type="hidden" name="approve_id" value="<?= $dish['id'] ?>">
                <button class="bg-green-600 hover:bg-green-500 text-white px-6 py-2 rounded-full text-xs font-bold transition-all">承認して公開</button>
            </form>
        </div>
        <?php endforeach; ?>
        <?php if(empty($pending_dishes)): ?> <p class="text-slate-500">承認待ちはありません。</p> <?php endif; ?>
    </div>
</body>
</html>