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
    'App\Notifications\OrderCreated' => 'A new order with ID :order is requested from you. Pls check  and handle it .',
    'message_sent' => 'Thank you . Your message has been sent',
    'newsletter_sent' => ' Sending is running in background process . After finish you can see count receivers in the list  ',
    'search_not_found' => 'Sorry , could not find anything matches : :search_key ',
    'search_try_again' => 'try:
                            - use more common words.
                            - check the word dictation.',
    'reduce_filters' => 'reduce some of filers',
    'basket_is_empty' => 'Your basket is empty ! ',
    'product_out_of_stock' => 'product ":name_pro" is out of stock . please remove it from your basket or you can contact the owner',
    'shop_desc' => 'After seeing this page if you did not pay the final price  Pls refresh the page til the stock check again because the stock might be finished in the while . thank you for your trust  ',
    'can_not_delete_for_basket' => 'The product is in some basket(s). And Can not be deleted ',
    'can_not_delete_for_pro_basket' => 'This user owns at least a products that is in one basket. And Can not be deleted',
    'order_created'=>'Order is created . You can track your orders from this page . Pls wait until the owner confirm your order and save the post tracking number . we will aware you with your mail address ',
    'order_created_notify' => 'You have an order ',
    'owner_order_desc'=>' An order with following details by ":shopper" is requested from you  .Pls  "confirm the order" OR  "describe the problems"'

];

?>
