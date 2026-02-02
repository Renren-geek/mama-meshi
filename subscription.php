<?php
require 'db.php';
$plans = [
    ['name' => 'お試し3食セット', 'price' => 2400, 'desc' => 'まずは週に一度、実家の味を。'],
    ['name' => '平日5食おまかせ便', 'price' => 3800, 'desc' => '平日の「エサ化」を防ぐ、究極の自炊代行。'],
    ['name' => '贅沢7食フルセット', 'price' => 5000, 'desc' => '一週間、毎日違うママの手料理を味わう。']
];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ママめし定期便 - 温かい手料理を、日常に。</title>
</head>
<body class="bg-orange-50 text-stone-800 pb-20">

    <nav class="p-6">
        <a href="index.php" class="text-orange-600 font-bold flex items-center gap-2">
            <span class="text-xl">←</span> 戻る
        </a>
    </nav>

    <main class="max-w-4xl mx-auto px-6">
        <section class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black text-stone-900 mb-6 leading-tight">
                「ただいま」の後に、<br><span class="text-orange-500">温かい手料理</span>が待っている。
            </h1>
            <p class="text-stone-600 text-lg max-w-2xl mx-auto leading-relaxed">
                忙しい毎日の食事が「エサ化」していませんか？<br>
                ママめし定期便は、厳選されたママたちの手作り料理を、<br>
                あなたのライフスタイルに合わせて定期的にお届けします。
            </p>
        </section>

        <section class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white p-8 rounded-[2rem] shadow-sm text-center">
                <div class="text-3xl mb-4"></div>
                <h3 class="font-bold mb-2">旬の献立</h3>
                <p class="text-xs text-stone-500">お母様たちが旬の食材で、その時一番美味しい物語を紡ぎます。</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-sm text-center border-2 border-orange-200">
                <div class="text-3xl mb-4"></div>
                <h3 class="font-bold mb-2">自由なサイクル</h3>
                <p class="text-xs text-stone-500">週1回から月1回まで。スキップも解約もスマホひとつで。</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-sm text-center">
                <div class="text-3xl mb-4"></div>
                <h3 class="font-bold mb-2">鮮度をそのまま</h3>
                <p class="text-xs text-stone-500">作りたての「温かさ」を損なわない配送でお届けします。</p>
            </div>
        </section>

        <section class="mb-20">
            <h2 class="text-2xl font-bold text-center mb-10">プランを選ぶ</h2>
            <div class="space-y-4">
                <?php foreach($plans as $plan): ?>
                <div class="bg-white p-6 rounded-3xl flex items-center justify-between hover:ring-2 hover:ring-orange-500 transition-all cursor-pointer shadow-sm">
                    <div>
                        <h4 class="text-xl font-bold"><?= $plan['name'] ?></h4>
                        <p class="text-sm text-stone-400 mt-1"><?= $plan['desc'] ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-black text-stone-800">¥<?= number_format($plan['price']) ?></p>
                        <p class="text-[10px] text-stone-400 font-bold uppercase">Tax Included</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="bg-stone-900 text-white rounded-[3rem] p-10 text-center">
            <h3 class="text-2xl font-bold mb-4 text-orange-400">一歩踏み出して、食卓に彩りを。</h3>
            <p class="text-stone-400 mb-8 text-sm">※定期便はいつでもマイページから停止可能です。</p>
            <button class="bg-orange-500 text-white font-black px-12 py-5 rounded-2xl shadow-2xl hover:bg-orange-600 transition-all scale-110">
                定期便を申し込む
            </button>
        </section>
    </main>

</body>
</html>