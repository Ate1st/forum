<?php use app\classes\render?>
<?php $messages = render\block_vars::get('messages')?>
<?php $teme = render\block_vars::get('teme')?>
<?php $users_list = render\block_vars::get('users_list')?>


<h3>Тема: <?= $teme->getProperty('name')?></h3>

<table class="table table-hover table-responsive">
    <tbody>
        <?php for($i = 0; $i < count($messages); $i++) {?>
        <tr>
            <td>
                <div class="col-md-2">
                    <h4 class="alert-primary"> <?= $users_list[$i]->getProperty('name')?> </h4>
                </div>
                <div class="col-md-10">
                    <?= $messages[$i]->getProperty('text')?>
                </div>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>

<form method="post" action="/forum/actionAdd_message?tid=<?= $teme->getProperty('id')?>">
    <textarea class="form-control" id="text" name="text" lines="5"></textarea>
    <button class="btn btn-default" type="submit">Отправить</button>
</form>