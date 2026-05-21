<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>">&laquo;</a>
            </li>
            <li>
                <a href="<?= $pager->getPreviousPage() ?>">&lsaquo;</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="<?= $link['active'] ? 'active' : '' ?>">
                <?php if ($link['active']) : ?>
                    <span><?= $link['title'] ?></span>
                <?php else : ?>
                    <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                <?php endif ?>
            </li>
        <?php endforeach ?>

        <?php if ($pager->getCurrentPageNumber() < $pager->getPageCount()) : ?>
            <li>
                <a href="<?= $pager->getNextPage() ?>">&rsaquo;</a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>">&raquo;</a>
            </li>
        <?php endif ?>
    </ul>
</nav>
