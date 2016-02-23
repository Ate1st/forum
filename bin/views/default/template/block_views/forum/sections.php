<?php use app\classes\render?>
<?php $sections = render\block_vars::get('sections')?>
<?php $temes_count = render\block_vars::get('temes_count')?>
<?php $messages_count = render\block_vars::get('messages_count')?>
<?php $last_temes = render\block_vars::get('last_temes')?>

<table class="table table-responsive table-hover">
    <thead>
        <tr>
            <td>Форум</td>
            <td>Темы</td>
            <td>Сообщения</td>
            <td>Последняя тема</td>
        </tr>
    </thead>
    
    <tbody>
    <?php for ($i = 0; $i < count($sections); $i++) {?>
        <tr>
            <td><h5><a href="/forum/forum&sectionid=<?= $sections[$i]->getProperty('id')?>"><?= $sections[$i]->getProperty('name')?> </a> </h5></td>
            <td><h5> <?= $temes_count[$i]?> </h5></td>
            <td><h5> <?= $messages_count[$i]?> </h5></td>
            <td><h5> <a href="/forum/teme&tid=<?= $last_temes[$i]->getProperty('id')?>">
            <?= $last_temes[$i]->getProperty('name')?></a> </h5></td>
        </tr>
    <?php }?>
    </tbody>
           
    
</table>

