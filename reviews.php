<?php
require 'db.php';
// デモ用に最新の投稿を取得
$reviews = [
    ['user' => 'タカナシ', 'mama' => '恵子ママ', 'dish' => '肉じゃが', 'comment' => '仕事でボロボロになって帰宅したあと、この肉じゃがを食べて涙が出そうになりました。本当に実家の味です。', 'date' => '2026.02.01'],
    ['user' => '佐藤', 'mama' => 'よしこママ', 'dish' => 'サバの味噌煮', 'comment' => '子供が魚嫌いなのですが、こちらの味噌煮は完食して「また食べたい」と言っていました！', 'date' => '2026.01.30']
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><script src="https://cdn.tailwindcss.com"></script><title>ごちそうさま投稿 - ママめし</title></head>
<body class="bg-stone-50 text-stone-800 pb-20">
    <header class="p-6 bg-white border-b sticky top-0 z-50 flex items-center">
        <a href="index.php" class="text-stone-400 mr-4">←</a>
        <h1 class="font-bold flex-1 text-center">ごちそうさま投稿</h1>
    </header>

    <main class="max-w-2xl mx-auto p-6">
        <div class="mb-10 text-center">
            <h2 class="text-xl font-black mb-2">温かい言葉の輪</h2>
            <p class="text-xs text-stone-500 italic">ママたちの元気の源は、あなたの「ごちそうさま」です。</p>
        </div>

        <div class="space-y-6">
            <?php foreach($reviews as $r): ?>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-stone-100">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] font-black bg-orange-100 text-orange-600 px-2 py-1 rounded-md tracking-widest uppercase"><?= $r['mama'] ?>へ</span>
                    <span class="text-[10px] text-stone-300 font-bold"><?= $r['date'] ?></span>
                </div>
                <p class="text-sm font-bold text-stone-800 mb-2">料理：<?= $r['dish'] ?></p>
                <p class="text-sm text-stone-600 leading-relaxed italic">「<?= $r['comment'] ?>」</p>
                <div class="mt-4 pt-4 border-t border-stone-50 flex items-center gap-2">
                    <div class="w-6 h-6 bg-stone-100 rounded-full"></div>
                    <span class="text-xs font-bold text-stone-400"><?= $r['user'] ?>さんより</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="fixed bottom-8 right-6">
            <button class="bg-orange-500 text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center text-2xl font-bold">＋</button>
        </div>
    </main>
</body>
</html>