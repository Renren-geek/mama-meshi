<?php
require 'db.php';
session_start();

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = "お問い合わせを受け付けました。運営より3日以内にご連絡いたします。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>お問い合わせ - ママめし</title>
</head>
<body class="bg-stone-50 text-stone-800 pb-20">

    <header class="bg-white p-4 border-b sticky top-0 z-50">
        <div class="max-w-2xl mx-auto flex items-center">
            <a href="index.php" class="text-stone-400 text-xl">←</a>
            <h1 class="flex-1 text-center font-bold">お問い合わせ</h1>
        </div>
    </header>

    <main class="max-w-2xl mx-auto p-6">
        
        <section class="mb-12 bg-gradient-to-br from-orange-400 to-orange-500 rounded-[2.5rem] p-8 text-white shadow-xl shadow-orange-100">
            <h2 class="text-2xl font-black mb-4">ママとして、手料理を届けませんか？</h2>
            <p class="text-orange-50 text-sm leading-relaxed mb-6">
                あなたの「当たり前」の家庭料理は、誰かにとっての「宝物」です。
                ママめしでは、心を込めて料理を作ってくださるクリエイター（ママ）を募集しています。
            </p>
            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-2xl text-xs border border-white/30">
                <p class="font-bold">✨ こんな方を募集しています：</p>
                <ul class="mt-2 space-y-1 opacity-90">
                    <li>・お料理を通じて誰かを笑顔にしたい方</li>
                    <li>・ご自身の料理の物語・思い出を大切にされている方</li>
                    <li>・和食の知恵を次世代へ繋ぎたい方</li>
                </ul>
            </div>
        </section>

        <?php if($msg): ?>
            <div class="bg-green-100 border-2 border-green-200 text-green-700 p-4 rounded-2xl mb-8 text-center font-bold">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-stone-100 space-y-4">
                <div>
                    <label class="block text-xs font-black text-stone-400 uppercase tracking-widest mb-2">お問い合わせ項目</label>
                    <select name="type" class="w-full bg-stone-50 border-none rounded-xl p-4 ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
                        <option value="user">サービス利用について</option>
                        <option value="mama">ママとしての登録について</option>
                        <option value="business">法人・提携のご相談</option>
                        <option value="other">その他</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-400 uppercase tracking-widest mb-2">お名前</label>
                    <input type="text" name="name" required placeholder="高梨 太郎" class="w-full bg-stone-50 border-none rounded-xl p-4 ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-400 uppercase tracking-widest mb-2">メールアドレス</label>
                    <input type="email" name="email" required placeholder="example@mama-meshi.jp" class="w-full bg-stone-50 border-none rounded-xl p-4 ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-black text-stone-400 uppercase tracking-widest mb-2">メッセージ内容</label>
                    <textarea name="content" rows="6" required placeholder="ご質問などご記載ください" class="w-full bg-stone-50 border-none rounded-xl p-4 ring-1 ring-stone-100 focus:ring-2 focus:ring-orange-500 outline-none"></textarea>
                </div>

                <button type="submit" class="w-full bg-stone-900 text-white font-black py-5 rounded-2xl shadow-xl active:scale-[0.98] transition-all mt-4">
                    メッセージを送る
                </button>
            </div>
        </form>

        <p class="text-center text-stone-400 text-[10px] mt-8">
            © 2026 ママめし <br>
        </p>
    </main>

</body>
</html>