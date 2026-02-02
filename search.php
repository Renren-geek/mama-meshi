<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><script src="https://cdn.tailwindcss.com"></script><title>こだわり検索 - ママめし</title></head>
<body class="bg-stone-50 text-stone-800">
    <header class="p-6 bg-white border-b"><h1 class="font-bold text-center italic">手料理を探す</h1></header>

    <main class="max-w-2xl mx-auto p-6">
        <div class="mb-10">
            <input type="text" placeholder="食材、ママの名前など..." class="w-full p-4 bg-white rounded-2xl shadow-sm border-none ring-1 ring-stone-200 outline-none focus:ring-2 focus:ring-orange-500">
        </div>

        <section class="mb-10">
            <h3 class="text-xs font-black text-stone-400 uppercase tracking-widest mb-4 ml-2">こだわり条件</h3>
            <div class="flex flex-wrap gap-3">
                <?php $tags = ['無添加', '減塩', '地元野菜', 'ボリューム満点', '子供向け', 'お酒に合う', 'お祝い', '冷凍可']; 
                foreach($tags as $tag): ?>
                <button class="bg-white px-4 py-2 rounded-full text-xs font-bold border border-stone-100 hover:border-orange-500 hover:text-orange-500 transition-all shadow-sm"><?= $tag ?></button>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="mb-10">
            <h3 class="text-xs font-black text-stone-400 uppercase tracking-widest mb-4 ml-2">ママの年代</h3>
            <div class="grid grid-cols-2 gap-4">
                <button class="p-4 bg-white rounded-2xl text-sm font-bold border border-stone-100">40〜50代ママ</button>
                <button class="p-4 bg-white rounded-2xl text-sm font-bold border border-stone-100 italic">60代〜ベテランママ</button>
            </div>
        </section>

        <button class="w-full bg-stone-900 text-white font-black py-5 rounded-2xl shadow-xl">この条件で手料理を見る</button>
    </main>
</body>
</html>