<?php
define('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/E-Commerce/');
define('CART_COOKIE','SBwi72UCklwiqzz2');
define('CART_COOKIE_EXPIRE',time()+(86400*30));
define('GSTRATE',0.28);

/*define('CURRENCY','usd');
define('CHECKOUTMODE', 'TEST');

if (CHECKOUTMODE=='TEST') {
	define('STRIPE_PRIVATE', 'sk_test_H4aPfW5Du1bxzH1tzJK3qHSu');
	define('STRIPE_PUBLIC', 'pk_test_9B6UXZ8CMqH7lOuCmBpRCJaS');
}*/
//if (CHECKOUTMODE=='LIVE') {
//	define('STRIPE_PRIVATE', 'value');
//	define('STRIPE_PUBLIC', 'value');
//}

?>