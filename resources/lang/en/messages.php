<?php

return [
    'created' => 'Data has been saved successfully',
    'updated' => 'The record has been updated successfully',
    'deleted' => 'The record has been removed successfully',
    'owner_required'=> 'the owner is required and should be selected from dynamic data',
    'receiver_required'=> 'the receiver is required and should be selected from dynamic data',
    'product_created' => ' New Product Created',
    'owner_created_product' => ' has created new product . please go to your dashboard to confirm the product from this link ',
    'product_confirm' => 'Confirm The Product',
    'App\Notifications\ProductCreated' => 'The Product with ID :id_product By User :name_user with Id :id_user Has Created and It needs to be confirmed  ',
    'notification_user_product'=>'A product Has been added to  :site_name  by you . An email has been sent to Admins to confirm your product . Please be patient after confirmation your product will be shown in site ',
    'filed_changed' => 'The Value of :field_title Has Changed ',
    'product_changed' => 'The product Has Changed By Owner',
    'App\Notifications\ProductChanged'=> 'The Product with ID :id_product By User :name_user with Id :id_user Has changed . Since it was confirmed before so check the product and see if there is no problem   ',
    'admin_notify' => 'A notification has sent you by admin',
    'error_happened' => 'there is a problem in site . please contact backends',
    'App\Notifications\AdminNotifyUser' => 'Admin :sender : :desc (about product :id_product)',
    'message_sent' => 'Thank you . Your message has been sent',
    'newsletter_sent' => ' Sending is running in background process . After finish you can see count receivers in the list  '
];

?>
