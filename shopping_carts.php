<?php
require 'db.php';
session_start();

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['dish_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id] = ['title' => $title, 'price' => $price, 'qty' => 1];
    }
}

if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8"><script src="https://cdn.tailwindcss.com"></script><title>カート - ママめし</title></head>
<body class="bg-orange-50 p-6 md:p-12">
    <div class="max-w-2xl mx-auto bg-white p-10 rounded-[3rem] shadow-2xl">
        <h2 class="text-2xl font-black mb-10 italic border-b pb-4">ショッピングカート</h2>

        <?php if (empty($_SESSION['cart'])): ?>
            <p class="text-center py-10 text-stone-400 font-bold text-sm">カートは空です。手料理を探しに行きましょう！</p>
            <a href="index.php" class="block text-center bg-stone-900 text-white py-4 rounded-2xl font-black">ホームへ戻る</a>
        <?php else: ?>
            <form method="POST">
                <div class="space-y-6">
                    <?php $total = 0; foreach ($_SESSION['cart'] as $id => $item): 
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    ?>
                    <div class="flex items-center justify-between border-b border-stone-100 pb-6">
                        <div>
                            <h4 class="font-bold"><?= htmlspecialchars($item['title']) ?></h4>
                            <p class="text-xs text-orange-500 font-black">¥<?= number_format($item['price']) ?></p>
                        </div>
                        <div class="flex items-center gap-4">
                            <input type="number" name="qty[<?= $id ?>]" value="<?= $item['qty'] ?>" min="0" class="w-16 p-2 bg-stone-50 rounded-lg text-center font-black">
                            <p class="text-sm font-black w-20 text-right">¥<?= number_format($subtotal) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-10 flex justify-between items-center px-4 py-6 bg-stone-50 rounded-2xl">
                    <span class="font-bold text-stone-400 uppercase tracking-widest text-[10px]">合計金額 (送料別)</span>
                    <span class="text-3xl font-black text-stone-900 italic">¥<?= number_format($total) ?></span>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <button name="update_cart" class="py-4 bg-stone-100 text-stone-500 rounded-2xl font-black text-xs hover:bg-stone-200">数量を更新</button>
                    <button class="py-4 bg-orange-500 text-white rounded-2xl font-black shadow-lg shadow-orange-100 active:scale-95">注文手続きへ</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>