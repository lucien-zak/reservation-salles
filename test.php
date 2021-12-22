<?php
var_dump(date('Y-m-d H:i:s', strtotime('+2 hour')));

if (date('Y-m-d H:i:s', strtotime('-2 hour')) < date('Y-m-d H:i:s', strtotime('+2 hour'))) {
    var_dump('Oui');
} else {
    var_dump('Non');
}
?>