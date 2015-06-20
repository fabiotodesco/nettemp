<?php
$rand=substr(rand(), 0, 4);
$humidexit = isset($_POST['humidexit']) ? $_POST['humidexit'] : '';

if (($humidexit == "humidexit") ){
    $id_rom_newh='gpio_'.$gpio_post.'_humid';
    $id_rom_newt='gpio_'.$gpio_post.'_temp';
    $id_rom_h='gpio_'.$gpio_post.'_humid.sql';
    $id_rom_t='gpio_'.$gpio_post.'_temp.sql';

    $db->exec("UPDATE gpio SET mode='', status='' where gpio='$gpio_post' ") or die ("humid off db error");
    $db->exec("DELETE FROM sensors WHERE rom='$id_rom_newh' "); 
    $db->exec("DELETE FROM sensors WHERE rom='$id_rom_newt' "); 
    $db->exec("DELETE FROM newdev WHERE list='$id_rom_newh'"); 
    $db->exec("DELETE FROM newdev WHERE list='$id_rom_newt'"); 
    unlink("db/$id_rom_h");
    unlink("db/$id_rom_t");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }

$dht11_onoff = isset($_POST['dht11_onoff']) ? $_POST['dht11_onoff'] : '';
$dht11_onoff1 = isset($_POST['dht11_onoff1']) ? $_POST['dht11_onoff1'] : '';

if (($dht11_onoff1 == "dht11_onoff2") ){
    $db->exec("UPDATE gpio SET humid_type='$dht11_onoff', status='Humid DHT $dht11_onoff'  where gpio='$gpio_post' ") or die("exec error");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
$dht22_onoff = isset($_POST['dht22_onoff']) ? $_POST['dht22_onoff'] : '';
$dht22_onoff1 = isset($_POST['dht22_onoff1']) ? $_POST['dht22_onoff1'] : '';

if (($dht22_onoff1 == "dht22_onoff2") ){
    $db->exec("UPDATE gpio SET humid_type='$dht22_onoff', status='Humid DHT $dht22_onoff' where gpio='$gpio_post' ") or die("exec error");
    $db = null;
    header("location: " . $_SERVER['REQUEST_URI']);
    exit();
    }
?>
    <form action="" method="post">
	<input type="image" name="humid" value="off" src="media/ico/Close-2-icon.png" title="Back"   onclick="this.form.submit()" />
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<input type="hidden" name="humidexit" value="humidexit" />
    </form>
    
   <form action="" method="post">
	DHT11
	<input type="checkbox" name="dht11_onoff" value="11" <?php echo $a["humid_type"] == '11' ? 'checked="checked"' : ''; ?> onclick="this.form.submit()" />
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<input type="hidden" name="dht11_onoff1" value="dht11_onoff2" />
    </form>
    <form action="" method="post">
	DHT22
	<input type="checkbox" name="dht22_onoff" value="22" <?php echo $a["humid_type"] == '22' ? 'checked="checked"' : ''; ?> onclick="this.form.submit()" />
	<input type="hidden" name="gpio" value="<?php echo $a['gpio']; ?>"/>
	<input type="hidden" name="dht22_onoff1" value="dht22_onoff2" />
    </form>
