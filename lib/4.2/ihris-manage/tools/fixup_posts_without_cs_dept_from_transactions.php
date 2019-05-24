#!/usr/bin/php
<?php
/*
 * © Copyright 2007, 2008 IntraHealth International, Inc.
 * 
 * This File is part of iHRIS
 * 
 * iHRIS is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * The page wrangler
 * 
 * This page loads the main HTML template for the home page of the site.
 * @package iHRIS
 * @subpackage DemoManage
 * @access public
 * @author Carl Leitner <litlfred@ibiblio.org>
 * @copyright Copyright &copy; 2007, 2008 IntraHealth International, Inc. 
 * @since Demo-v2.a
 * @version Demo-v2.a
 */




$dir = getcwd();
chdir("../pages");
$i2ce_site_user_access_init = null;
$i2ce_site_user_database = null;
require_once( getcwd() . DIRECTORY_SEPARATOR . 'config.values.php');

$local_config = getcwd() . DIRECTORY_SEPARATOR .'local' . DIRECTORY_SEPARATOR . 'config.values.php';
if (file_exists($local_config)) {
    require_once($local_config);
}

if(!isset($i2ce_site_i2ce_path) || !is_dir($i2ce_site_i2ce_path)) {
    echo "Please set the \$i2ce_site_i2ce_path in $local_config";
    exit(55);
}

require_once ($i2ce_site_i2ce_path . DIRECTORY_SEPARATOR . 'I2CE_config.inc.php');

I2CE::raiseMessage("Connecting to DB");
putenv('nocheck=1');
if (isset($i2ce_site_dsn)) {
    @I2CE::initializeDSN($i2ce_site_dsn,   $i2ce_site_user_access_init,    $i2ce_site_module_config);         
} else if (isset($i2ce_site_database_user)) {    
    I2CE::initialize($i2ce_site_database_user,
                     $i2ce_site_database_password,
                     $i2ce_site_database,
                     $i2ce_site_user_database,
                     $i2ce_site_module_config         
        );
} else {
    die("Do not know how to configure system\n");
}

I2CE::raiseMessage("Connected to DB");

require_once($i2ce_site_i2ce_path . DIRECTORY_SEPARATOR . 'tools' . DIRECTORY_SEPARATOR . 'CLI.php');






ini_set('memory_limit','4G');

if (count($arg_files) != 1) {
    usage("Please specify the name of a spreadsheet to process");
}

reset($arg_files);
$file = current($arg_files);
if($file[0] == '/') {
    $file = realpath($file);
} else {
    $file = realpath($dir. '/' . $file);
}
if (!is_readable($file)  || ($fp = fopen($file,"r")) === false) {
    usage("Please specify the name of a spreadsheet to import: " . $file . " is not readable");
}

I2CE::raiseMessage("Looking for DPSM->CS codes from $file");


$expected_headers = array(
    'cs_unit_name'=>'New Location',
    'dpsm_code'=>'New Position',
    );

$headers = loadHeadersFromCSV($fp);
mapHeaders($headers);

$row = 0;
$cs_unit_names =array();
while (($data = fgetcsv($fp)) !== FALSE) {
    $row++;
    if ( ! ($mapped_data = mapData($data,$row))) {
        continue;
    }
    if (! ($dpsm_code = $mapped_data['dpsm_code'])) {
        continue;
    }
    if ($cs_unit_name = $mapped_data['cs_unit_name']) {
        $cs_names[$dpsm_code] = strtoupper(trim($cs_unit_name));
    }
}
fclose($fp);
ksort($cs_names);


$ff = I2CE_FormFactory::instance();
$user = new I2CE_User();


$where = array(
    'operator'=>'FIELD_LIMIT',
    'field'=>'cs_dept',
            'style'=>'null'
    );




$post_ids = I2CE_FormStorage::listFields('post',array('dpsm_code'),false,$where);
echo count($post_ids) . " bad posts\n";


if ( ($fp = fopen(dirname(__FILE__) . "/data/cs_dept_mispellings.newline.csv","r")) === false) {
    die("Cannot get mispellings");
}

$cs_alt_names = array();
while (($data = fgetcsv($fp)) !== FALSE) {
    if ($data[0] == 'id') {
        continue;
    }
    if (count($data) < 2) {
        continue;
    }
    $id = current($data);
    array_shift($data);
    foreach ($data as $k=>$v) {
        if (!$v) {
            unset($data[$k]);
        }
    }
    $cs_alt_names[$id] = $data;

}


$cs_ids =  array();
foreach (I2CE_FormStorage::listFields('cs_dept',array('name')) as $id=>$data) {
    if (!array_key_exists('name',$data) || ! ($name = strtoupper($data['name']))) {
        continue;
    }
    $cs_ids[$name] = $id;
    if (array_key_exists('cs_dept|' . $id,$cs_alt_names)) {
        foreach ($cs_alt_names['cs_dept|' . $id] as $alt_name) {
            $cs_ids[strtoupper(trim($alt_name))] = $id;
        }
    }

}
//print_r($cs_ids);

$add_unit = null;

foreach ($post_ids as $post_id=>$data) {
    if (  !is_array($data) || !array_key_exists('dpsm_code',$data) || !($dpsm_code = trim($data['dpsm_code'])) || ! ($postObj = $ff->createContainer(array('post',$post_id))) instanceof Botswana_Post) {
        continue;
    }
    $postObj->populate(true);
    $changed =false;
    $cs_field = $postObj->getField('cs_dept');
    if (!$cs_field->isValid() &&  array_key_exists($dpsm_code,$cs_names)) {
        $cs_name = strtoupper(trim($cs_names[$dpsm_code]));
        if (! array_key_exists($cs_names[$dpsm_code],$cs_ids) && prompt("Add the unit $cs_name?",$add_unit)) {
            $csDept = $ff->createContainer('cs_dept');
            $csDept->getField('name')->setValue($cs_name);
            $csDept->save($user);
            $cs_ids[$cs_name] = $csDept->getID();
        }
        $cs_field->setValue(array('cs_dept',$cs_ids[$cs_names[$dpsm_code]]));
        $changed = true;
        echo "Setting cs dept for $dpsm_code\n";
    }
    if ($changed) {
        $postObj->save($user);
    }
    $postObj->cleanup();

}





/*********************************************
*
*      Helper functions
*
*********************************************/

function loadHeadersFromCSV($fp) {
    $in_file_sep = false;
    foreach (array("\t",",") as $sep) {
        $headers = fgetcsv($fp, 4000, $sep);
        if ( $headers === FALSE|| count($headers) < 3) {
            fseek($fp,0);
            continue;
        }
        $in_file_sep = $sep;
    }
    if (!$in_file_sep) {
        die("Could not get headers\n");
    }
    foreach ($headers as &$header) {
        $header = trim($header);
    }
    unset($header);
    return $headers;
}

function mapHeaders($headers) {
    global $expected_headers;
    global $header_map;
    $header_map = array();
    foreach ($expected_headers as $expected_header_ref => $expected_header) {
        if (($header_col = array_search($expected_header,$headers)) === false) {
            I2CE::raiseError("Could not find $expected_header in the following headers:\n\t" . implode(" ", $expected_headers). "\nFull list of found headers is:\n\t" . implode(" ", $headers));
            die();
        }
        $header_map[$expected_header_ref] = $header_col;
    }
}

function mapData($data,$row) {
    global $header_map;
    $mapped_data = array();
    foreach ($header_map as $header_ref=>$header_col) {
        if (!array_key_exists($header_col,$data)) {
            $mapped_data[$header_ref] = false;
        } else {
            $mapped_data[$header_ref] = $data[$header_col];
        }
    }
    
    return $mapped_data;
}

# Local Variables:
# mode: php
# c-default-style: "bsd"
# indent-tabs-mode: nil
# c-basic-offset: 4
# End:
