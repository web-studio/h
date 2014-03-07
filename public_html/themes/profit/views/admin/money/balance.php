
<table class="">
    <tr>
        <?php foreach ( $balances as $purse=>$value ) : ?>
            <td><?= $purse ?></td><td><?= $value ?></td>
        <?php endforeach ?>
    </tr>
</table>