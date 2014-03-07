
<table class="items table">

    <?php foreach ( $balances as $purse=>$value ) : ?>
        <tr>
            <td><?= $purse ?></td><td><?= $value ?></td>
        </tr>
    <?php endforeach ?>

</table>