<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
<?php view("partials/head.php") ?>

<div class="max-w py-4 rounded shadow-lg">
    <a href="/notes" class="text-blue-500">Go back...</a>
    <div class="px-4 py-4">
        <p class="text-gray-700 text-base">
            <?= htmlspecialchars($note['body']) ?>
        </p>
    </div>
    <div class="flex justify-end">
        <form method="post">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" value="<?= $note['id'] ?>" name="id" />
            <button type="submit" class="bg-red-500 p-3 m-3 rounded text-white hover:bg-red-700">
                Delete
            </button>
        </form>
        <a
            href="/note/edit?id=<?=$note['id']?>" 
        class="bg-blue-500 p-3 m-3 rounded text-white hover:bg-blue-700">
            Edit
        </a>
    </div>
</div>

<?php view("partials/footer.php") ?>