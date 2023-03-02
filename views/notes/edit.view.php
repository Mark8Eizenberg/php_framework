<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
<?php view("partials/head.php") ?>

<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/note?id=<?=$note['id']?>" class="text-blue-500">Go back...</a>
    <form method="post" action="/note">
        <input type="hidden" name="_method" value="PATCH"/>
        <input type="hidden" name="id" value="<?= $note['id']?>"/>
        <div class="relative mb-3 xl:w-96" data-te-input-wrapper-init>
            <textarea 
                name="body" 
                class="peer block min-h-[auto] w-full rounded border-2 bg-transparent py-[0.32rem] px-3 leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" 
                id="body" 
                rows="3" 
                placeholder=""><?= htmlspecialchars($note['body']) ?></textarea>
            <label for="body" class="pointer-events-none absolute top-0 left-3 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">

            </label>
            <?php if(isset($errors['body'])): ?>
                <small class="text-red-500" ><?= $errors['body'] ?></small>
            <?php endif; ?>
        </div>
        <p class="flex justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white rounded p-3 m-2" 
                type="submit">
                Save
            </button>
            <a
            href="/note?id=<?= $note['id']?>" 
            class="bg-red-500 hover:bg-red-700 text-white rounded p-3 m-2">
                Cancel
            </a>
        </p>
    </form>
</div>
<?php view("partials/footer.php") ?>