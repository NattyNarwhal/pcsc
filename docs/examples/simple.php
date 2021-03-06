<?php

if (!extension_loaded('pcsc')) {
  dl('pcsc.so');
}

# Get a PC/SC context
echo ">> Create Context\n";
$context = scard_establish_context();
var_dump($context);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Get the reader list
echo ">> Get Readers\n";
$readers = scard_list_readers($context);
var_dump($readers);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Use the first reader
echo ">> Select Reader\n";
$reader = $readers[1];
echo "Using reader: ", $reader, "\n";

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Connect to the card
echo ">> Connect to Card\n";
 $card  = scard_connect($context, $reader, 2);
var_dump( $card );

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Begin Transaction
echo ">> Begin Transaction\n";
$begin= scard_begin_transaction($card);
var_dump($begin);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Select Applet APDU
echo ">> Select Applet\n";
$apdu = "00a4040c0cD2760001354B414E4D30310000";
$res = scard_transmit($card , $apdu);
var_dump($res);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# test APDU
echo ">> Send APDU\n";
$apdu = "0084000008";
$res = scard_transmit($card, $apdu);
var_dump($res);
#echo pack("H*", $res), "\n";

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# End Transaction
echo ">> End Transaction\n";
$begin= scard_end_transaction($card);
var_dump( $card );

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Show Status
echo ">> Show Status\n";
$status = scard_status($card);
var_dump($status);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

# Release the PC/SC context
echo ">> Release Context\n";
scard_release_context($context);

$errno = scard_last_errno();
var_dump($errno);
$errstr = scard_errstr($errno);
var_dump($errstr);
echo "\n";

?>
