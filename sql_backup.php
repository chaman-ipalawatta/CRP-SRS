<?php
include 'sql.php';

include "include/menu.php.inc";
//save file
$handle = fopen('db_backup\db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');

fwrite($handle,sql::backup_tables('*'));
fclose($handle);
?>

<div id="databaseMsg" class="message">
        <p>Database backup successful. Please make a copy and keep it safe!</p>
</div>