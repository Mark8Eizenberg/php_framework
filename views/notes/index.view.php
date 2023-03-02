<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
<?php view("partials/head.php", ['heading' => $heading]) ?>
<?php foreach($notes as $note): ?>
    <div class="max-w rounded overflow-hidden shadow-lg">
        <div class="px-6 py-4">
            <a class="font-bold text-xl mb-2" href="/note?id=<?= $note['id'] ?>"><?= substr( htmlspecialchars($note['body']), 0, 20).'...' ?></a>
        </div>
    </div>
<?php endforeach; ?>

<div class="mt-4 ml-4">
    <a class="bg-blue-500 hover:bg-blue-700 text-white py-3 px-3 max-w rounded"
        href="/notes/create">Add note</a>
</div>
<?php view("partials/footer.php") ?>