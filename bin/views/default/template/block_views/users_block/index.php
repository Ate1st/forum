<?php use app\classes\render?>
<?php $user = render\block_vars::get('user')?>

Вы вошли как: <?= $user->getProperty('name')?>


