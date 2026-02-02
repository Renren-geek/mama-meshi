<?php
require 'db.php';
session_start();

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$featured_dishes = $pdo->query("SELECT * FROM dishes WHERE status = 'approved' LIMIT 6")->fetchAll();
$cookers = $pdo->query("SELECT * FROM users WHERE role = 'mama' LIMIT 4")->fetchAll();
$reviews = $pdo->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 3")->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ママめし - 温かい家庭料理を、お母さんの手作りで。</title>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 pb-20">

    <header class="bg-white border-b border-stone-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <h1 class="text-2xl font-black text-orange-500 italic"><a href="index.php">ママめし</a></h1>
            
            <div class="flex items-center gap-6">
                <a href="register.php?role=mama" class="hidden md:block text-sm font-black text-orange-600 border-2 border-orange-600 px-6 py-2 rounded-full hover:bg-orange-600 hover:text-white transition-all">お料理を作るママの登録はこちら</a>
                
                <nav class="hidden lg:flex gap-6 text-xs font-black text-stone-400">
                    <a href="about.php" class="hover:text-orange-500">ママめしとは？</a>
                    <a href="cooker.php" class="hover:text-orange-500">調理人（ママ）</a>
                    <a href="#reviews" class="hover:text-orange-500">ごちそうさまの声</a>
                    <a href="guide.php" class="hover:text-orange-500">ご利用ガイド</a>
                </nav>

                <div class="flex gap-4 items-center border-l pl-6">
                    <a href="shopping_carts.php" class="relative text-2xl">🛒
                        <?php if(!empty($_SESSION['cart'])): ?>
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full"><?= count($_SESSION['cart']) ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section class="w-full h-[45vh] bg-stone-200 relative flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <img src="img/hero_home.jpg" alt="温かい食卓" class="absolute inset-0 w-full h-full object-cover">
        <div class="relative z-20 text-center text-white px-4">
            <h2 class="text-3xl md:text-5xl font-black mb-4 leading-tight text-orange-500">母の味を届けます</h2>
            <p class="text-sm md:text-lg font-bold opacity-90 tracking-widest">日本中のお母さんの手料理をあなたのもとへ</p>
        </div>
    </section>

    <section class="bg-white py-16 border-b border-stone-100">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-black mb-6 text-orange-500">ママめしとは？</h3>
            <p class="text-stone-600 leading-loose font-medium text-sm md:text-base">
                効率が当たり前になった今、私たちが一番求めていたのは、人の「温かさ」ではないでしょうか。<br>
                ママめしは、コンビニ飯や外食では味わえない、日本中の家庭に眠る「お母さんの味」を届けるプラットフォームです。<br>
                地域のベテラン主婦の方々が作る、手間暇かけた愛情たっぷりの料理をお楽しみください。
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row">
        
        <aside class="w-full md:w-64 p-6 border-r border-stone-100 bg-white md:bg-transparent">
            <h2 class="text-xs font-black text-stone-300 uppercase tracking-widest mb-6">カテゴリーから探す</h2>
            <ul class="grid grid-cols-3 md:grid-cols-1 gap-2">
                <?php foreach($categories as $cat): ?>
                <li>
                    <a href="search.php?category=<?= $cat['id'] ?>" class="block p-3 text-xs font-bold hover:bg-orange-50 hover:text-orange-600 rounded-xl transition-all border border-transparent hover:border-orange-100 text-center md:text-left">
                        <?= htmlspecialchars($cat['name']) ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <main class="flex-1 p-6 md:p-10 space-y-24">

            <section>
                <h3 class="text-2xl font-black mb-8 italic">みんなのおすすめ料理</h3>
                <div class="flex gap-6 overflow-x-auto pb-6 no-scrollbar">
                    <?php foreach($featured_dishes as $dish): ?>
                    <div class="min-w-[300px] bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden group hover:shadow-xl transition-all">
                        <div class="h-48 bg-stone-100 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?= $dish['image_url'] ?>')"></div>
                        <div class="p-6">
                            <h4 class="font-bold text-lg"><?= htmlspecialchars($dish['title']) ?></h4>
                            <div class="flex justify-between items-center mt-4">
                                <span class="text-orange-500 font-black text-xl">¥<?= number_format($dish['price']) ?></span>
                                <a href="detail.php?id=<?= $dish['id'] ?>" class="bg-stone-900 text-white text-[10px] px-6 py-2 rounded-full font-black tracking-widest">手料理を見る</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="cookers">
                <div class="flex justify-between items-end mb-8">
                    <h3 class="text-2xl font-black italic">料理を作るママたち</h3>
                    <a href="cooker.php" class="text-xs font-bold text-orange-600 underline">ママをもっと見る</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <?php foreach($cookers as $mama): ?>
                    <div class="text-center group">
                        <div class="w-32 h-32 mx-auto rounded-full bg-stone-200 mb-4 border-4 border-white shadow-lg overflow-hidden relative">
                            <img src="img/mama_<?= $mama['id'] ?>.jpg" onerror="this.src='img/mama_default.png'" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        <p class="font-black text-stone-800"><?= htmlspecialchars($mama['name']) ?>さん</p>
                        <p class="text-[10px] text-orange-500 font-bold"><?= $mama['age_group'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <section id="reviews" class="bg-stone-100 -mx-6 px-6 py-24 rounded-[3rem] scroll-mt-20">
                <h3 class="text-2xl font-black mb-10 text-center italic">みんなのごちそうさまコメント</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php foreach($reviews as $rev): ?>
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm relative hover:-translate-y-2 transition-transform">
                        <span class="absolute -top-4 left-8 text-4xl text-orange-300 italic">“</span>
                        <p class="text-sm leading-relaxed mb-6 font-medium text-stone-600 italic">「<?= htmlspecialchars($rev['comment']) ?>」</p>
                        <div class="flex items-center gap-3 border-t pt-4">
                            <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-[10px]">👤</div>
                            <p class="text-[10px] font-black text-stone-400"><?= htmlspecialchars($rev['user_name']) ?>さん</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-12">
                    <a href="reviews.php" class="inline-block bg-stone-900 text-white text-xs font-bold px-8 py-3 rounded-full hover:bg-orange-600 transition-colors">すべての声を見る</a>
                </div>
            </section>

            <section class="bg-orange-500 rounded-[3.5rem] p-12 text-white overflow-hidden shadow-2xl relative min-h-[350px] flex items-center">
                <div class="relative z-10 max-w-lg">
                    <h3 class="text-4xl font-black mb-6 italic leading-tight">ママめし定期便</h3>
                    <p class="mb-10 opacity-90 font-bold text-lg">毎日頑張るあなたへ。実家の温もりを、決まった日に定期的にお届けします。</p>
                    <a href="subscription.php" class="inline-block bg-white text-orange-500 font-black px-12 py-5 rounded-2xl shadow-xl hover:scale-105 transition-all text-lg">プランを見る</a>
                </div>
                <img src="img/sub_bg.jpg" class="absolute inset-0 w-full h-full object-cover opacity-30">
            </section>

        </main>
    </div>

    <nav class="fixed bottom-0 inset-x-0 bg-white/80 backdrop-blur-md border-t flex justify-around py-4 text-[10px] font-black tracking-widest text-stone-400 z-50">
        <a href="index.php" class="text-orange-500 text-center">ホーム</a>
        <a href="search.php" class="text-center">探す</a>
        <a href="shopping_carts.php" class="text-center">カート</a>
        <a href="creator_post.php" class="text-center">ママ専用</a>
    </nav>

</body>
</html>