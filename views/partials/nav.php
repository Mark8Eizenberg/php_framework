<?php

$navs = [
    [
        "path" => "/",
        "name" => "Home"
    ],
    [
        "path" => "/notes",
        "name" => "Notes"
    ],
    [
        "path" => "/about",
        "name" => "About"
    ],
    [
        "path" => "/contact",
        "name" => "Contact"
    ],
];

?>

<ul class="flex border-b">
    <?php foreach ($navs as $nav) : ?>
        <?php if (urlIs($nav['path'])) : ?>
            <li class="-mb-px mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="<?= $nav['path'] ?>"><?= $nav['name'] ?></a>
            <?php else : ?>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="<?= $nav['path'] ?>"><?= $nav['name'] ?></a>
            <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li class="mr-1 plase-self-end">
            <a class="bg-red-500 rounded-t inline-block py-2 px-4 text-white hover:bg-red-800 font-semibold" href="/logout">Exit</a>
        </li>
</ul>