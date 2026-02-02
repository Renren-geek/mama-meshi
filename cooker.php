<?php
require 'db.php';
session_start();
$mama_id = 1; 

$mama = [
    'name' => 'れんママ',
    'location' => '千葉県 八千代市',
    'follower_count' => '3,105',
    'message' => '「おいしい」のあとの、ほっとした笑顔が私の元気の源です。',
    'story' => '息子が小さい頃、好き嫌いが多くて悩んでいました。どうにかして食べてほしい一心で、野菜を細かく刻んだり、出汁の取り方を工夫したり…。そんな日々の積み重ねが、今の私の味になっています。今は独立した息子の代わりに、頑張っている皆さんに温かいご飯を届けたいと思っています。',
    'specialty' => '出汁を効かせた和食全般、飴色玉ねぎのハンバーグ'
];

$dishes = $pdo->query("SELECT * FROM dishes WHERE status = 'approved' LIMIT 3")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= $mama['name'] ?>のキッチン - ママめし</title>
</head>
<body class="bg-stone-50 text-stone-800 pb-20">

    <div class="relative h-72 bg-stone-200 overflow-hidden">
        <img src="img/mama_bg_<?= $mama_id ?>.jpg" alt="キッチンの風景" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/10"></div> <a href="index.php" class="absolute top-6 left-6 bg-white/80 backdrop-blur w-10 h-10 rounded-full flex items-center justify-center shadow-md z-20">←</a>
    </div>

    <main class="max-w-2xl mx-auto px-6 -mt-20">
        <div class="bg-white rounded-[3.5rem] p-10 shadow-xl shadow-stone-200/50 border border-stone-100 text-center relative z-10">
            
            <div class="w-28 h-28 mx-auto -mt-24 rounded-full border-4 border-white shadow-lg overflow-hidden bg-stone-100">
                <img src="img/mama_icon_<?= $mama_id ?>.jpg" alt="<?= $mama['name'] ?>さんの顔写真" class="w-full h-full object-cover">
            </div>

            <h1 class="text-3xl font-black mt-4"><?= $mama['name'] ?></h1>
            <p class="text-xs text-stone-400 mt-2 font-bold tracking-widest uppercase">📍 <?= $mama['location'] ?></p>
            
            <div class="flex justify-center gap-10 mt-8">
                <div class="text-center">
                    <p class="text-xl font-black"><?= $mama['follower_count'] ?></p>
                    <p class="text-[10px] text-stone-400 font-black uppercase tracking-tighter">フォロワー</p>
                </div>
                <div class="text-center">
                    <p class="text-xl font-black">4.9</p>
                    <p class="text-[10px] text-stone-400 font-black uppercase tracking-tighter">評価</p>
                </div>
            </div>

            <p class="mt-10 text-sm italic text-stone-600 leading-relaxed bg-orange-50/50 p-6 rounded-[2rem] border border-orange-100">
                「<?= $mama['message'] ?>」
            </p>
        </div>

        <section class="mt-12">
            <h2 class="text-xl font-black mb-6 border-l-4 border-orange-500 pl-4">わたしの物語</h2>
            <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-sm border border-stone-100">
                <p class="text-stone-600 leading-loose text-sm font-medium">
                    <?= nl2br(htmlspecialchars($mama['story'])) ?>
                </p>
                <div class="mt-8 pt-8 border-t border-stone-50">
                    <span class="text-[10px] font-black text-stone-300 uppercase tracking-widest">自慢の逸品</span>
                    <p class="text-md font-bold text-stone-800 mt-2"><?= $mama['specialty'] ?></p>
                </div>
            </div>
        </section>

        <section class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-black border-l-4 border-orange-500 pl-4">提供中のメニュー</h2>
            </div>
            <div class="grid gap-6">
                <?php foreach($dishes as $dish): ?>
                <a href="detail.php?id=<?= $dish['id'] ?>" class="bg-white p-5 rounded-[2.5rem] shadow-sm border border-stone-100 flex items-center gap-6 active:scale-[0.97] transition-all hover:shadow-md">
                    <div class="w-24 h-24 bg-stone-100 rounded-[2rem] flex-shrink-0 overflow-hidden">
                        <img src="<?= $dish['image_url'] ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-black text-stone-800"><?= htmlspecialchars($dish['title']) ?></h4>
                        <p class="text-orange-500 font-black text-xl mt-1">¥<?= number_format($dish['price']) ?></p>
                    </div>
                    <div class="bg-orange-50 w-10 h-10 rounded-full flex items-center justify-center text-orange-500 font-bold pr-1">→</div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="mt-16 flex gap-4">
            <button class="flex-1 bg-white border-2 border-orange-500 text-orange-500 font-black py-5 rounded-2xl shadow-sm hover:bg-orange-50 transition-colors">フォローする</button>
            <button class="flex-1 bg-orange-500 text-white font-black py-5 rounded-2xl shadow-lg shadow-orange-200 active:translate-y-1 transition-all">お問い合わせ</button>
        </div>
    </main>

</body>
</html>