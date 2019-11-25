<?php
function delete_form($url, $label = 'delete')
{
    $form = Form::open(['method' => 'DELETE', 'url' => $url, 'class' => 'delete']);
    $form .= Form::submit($label, ['class' => 'delete-btn']);
    $form .= Form::close();

    return $form;
}
