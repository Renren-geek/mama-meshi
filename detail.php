<?php
require 'db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM dishes WHERE id = ?");
$stmt->execute([$id]);
$dish = $stmt->fetch();

if (!$dish) {
    echo "手料理が見つかりませんでした。<a href='index.php'>ホームへ戻る</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= htmlspecialchars($dish['title']) ?> - ママめし</title>
</head>
<body class="bg-stone-50 text-stone-800 pb-32">

    <nav class="fixed top-0 inset-x-0 bg-white/80 backdrop-blur-md z-50 p-4 flex items-center border-b border-stone-100">
        <a href="index.php" class="text-stone-400 text-2xl px-2">←</a>
        <h1 class="flex-1 text-center font-black text-xs tracking-widest text-stone-400 uppercase">料理の物語</h1>
    </nav>

    <div class="pt-14">
        <div class="w-full h-96 overflow-hidden bg-stone-200">
            <img src="<?= htmlspecialchars($dish['image_url']) ?>" onerror="this.src='img/default_dish.jpg'" class="w-full h-full object-cover">
        </div>
    </div>

    <main class="max-w-2xl mx-auto px-6 -mt-12 relative z-10">
        <div class="bg-white rounded-[3rem] p-8 md:p-10 shadow-2xl shadow-stone-200/50 mb-8 border border-stone-50">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-3xl font-black leading-tight text-stone-800"><?= htmlspecialchars($dish['title']) ?></h2>
                <div class="text-right">
                    <p class="text-3xl font-black text-orange-500 italic">¥<?= number_format($dish['price']) ?></p>
                    <p class="text-[10px] text-stone-300 font-bold">税込・送料別</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-stone-100 rounded-full overflow-hidden border border-stone-100">
                    <img src="img/mama_icon_1.jpg" class="w-full h-full object-cover">
                </div>
                <a href="cooker.php" class="text-sm font-black text-stone-600 underline decoration-orange-300 decoration-2 underline-offset-4 hover:text-orange-500 transition-colors">
                    れんママのキッチンを訪ねる ➔
                </a>
            </div>

            <div class="bg-orange-50/50 p-6 rounded-[2rem] italic text-sm text-stone-600 border-l-8 border-orange-400 leading-relaxed font-medium">
                「<?= htmlspecialchars($dish['story_summary']) ?>」
            </div>
        </div>

        <section class="space-y-10">
            <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-stone-50">
                <h3 class="text-xl font-black mb-8 flex items-center gap-3">
                    <span class="w-2 h-8 bg-orange-500 rounded-full"></span>
                    この料理に込めた想い
                </h3>
                <p class="text-stone-600 leading-loose text-md whitespace-pre-wrap font-medium">
<?= htmlspecialchars($dish['story_detail']) ?>
                </p>
            </div>

            <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-stone-50">
                <h3 class="text-xl font-black mb-6 flex items-center gap-3">
                    <span class="w-2 h-8 bg-stone-200 rounded-full"></span>
                    ママからの美味しいアドバイス
                </h3>
                <ul class="text-md text-stone-500 space-y-4 font-medium">
                    <li class="flex gap-3">
                        <span class="text-orange-400">●</span> 
                        食べる直前に少しだけお醤油を垂らすと、香りが一層引き立ちますよ。
                    </li>
                    <li class="flex gap-3">
                        <span class="text-orange-400">●</span> 
                        残ったら翌朝にお出汁をかけて、お茶漬けにするのもおすすめです。
                    </li>
                </ul>
            </div>
        </section>
    </main>

    <div class="fixed bottom-0 inset-x-0 bg-white/95 backdrop-blur-2xl border-t border-stone-100 p-8 z-50">
        <div class="max-w-2xl mx-auto flex items-center gap-6">
            <div class="flex-1">
                <p class="text-[10px] font-black text-stone-300 uppercase tracking-widest mb-1">合計金額</p>
                <p class="text-2xl font-black text-stone-800 italic">¥<?= number_format($dish['price'] + 500) ?> <span class="text-[10px] text-stone-400 font-normal not-italic">(送料込)</span></p>
            </div>
            <form action="shopping_carts.php" method="POST" class="flex-1">
                <input type="hidden" name="dish_id" value="<?= $dish['id'] ?>">
                <input type="hidden" name="title" value="<?= htmlspecialchars($dish['title']) ?>">
                <input type="hidden" name="price" value="<?= $dish['price'] ?>">
                <button type="submit" name="add_to_cart" class="w-full bg-orange-500 text-white font-black py-5 rounded-[2rem] shadow-2xl shadow-orange-200 active:scale-95 transition-all text-lg tracking-widest">
                    カートに入れる
                </button>
            </form>
        </div>
    </div>

</body>
</html>