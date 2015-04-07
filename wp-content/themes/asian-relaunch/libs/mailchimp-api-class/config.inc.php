<?php
    //API Key - see http://admin.mailchimp.com/account/api
    $apikey = get_option('amr_mailchimp_apikey');
    
    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    $listId = get_option('amr_list_id');
    
    //some email addresses used in the examples:
//    $my_email = 'ntran@plusfactory.com';
//    $boss_man_email = 'INVALID@example.com';

    //just used in xml-rpc examples
    $apiUrl = get_option('amr_api_url');
	    
?>
<?php
/*
    //API Key - see http://admin.mailchimp.com/account/api
    $apikey = 'ae18dd8167f64dd43c59b7b7e48893da-us2';
    
    // A List Id to run examples against. use lists() to view all
    // Also, login to MC account, go to List, then List Tools, and look for the List ID entry
    $listId = '6ae1592fe0';
    
    //some email addresses used in the examples:
//    $my_email = 'ntran@plusfactory.com';
//    $boss_man_email = 'INVALID@example.com';

    //just used in xml-rpc examples
    $apiUrl = 'http://api.mailchimp.com/1.3/';
*/    
?>