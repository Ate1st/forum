<?php use app\classes\render?>
<?php $temes = render\block_vars::get('temes')?>
<?php $messages_count = render\block_vars::get('messages_count')?>
<?php $last_message = render\block_vars::get('last_message')?>
<?php $last_user = render\block_vars::get('last_user')?>



<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <td>Тема</td>
            <td>Ответы</td>
            <td>Последнее сообщение</td>
        </tr>
    </thead>
    <tbody>
        <?php for($i = 0; $i < count($temes); $i++) {?>
        <tr>
            <td><a href="/forum/teme?tid=<?= $temes[$i]->getProperty('id')?>"><?= $temes[$i]->getProperty('name')?></a></td>
            <td><?= $messages_count[$i]?></td>
            <td><?= $last_user[$i]->getProperty('name').' '.$last_message[$i]->getProperty('createdate')?></td>
        </tr>
        <?php }?>
    </tbody>
</table>