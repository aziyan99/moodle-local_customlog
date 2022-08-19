<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ${PLUGINNAME} file description here.
 *
 * @package    ${PLUGINNAME}
 * @copyright  2022 rajaazian <${USEREMAIL}>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$services = array(
    'customlogservice' => array(
        'functions' => array('local_customlog_fetch_log'),
        'requiredcapability' => '',
        'restrictedusers' => 0,
        'enabled' => 1,
        'shortname' => '',
        'downloadfiles' => 0,
        'uploadfiles' => 0
    )
);

$functions = array(
    'local_customlog_fetch_log' => array(
        'classname' => 'local_customlog_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname' => 'fetch_log',
        'classpath' => 'local/customlog/externallib.php',
        'description' => 'Fetch log by id',
        'type' => 'read',
        'ajax' => true,
//        'services' => array(MOODLE_OFFICIAL_MOBILE_SERVICE)    // Optional, only available for Moodle 3.1 onwards. List of built-in services (by shortname) where the function will be included.  Services created manually via the Moodle interface are not supported.
        'capabilities' => '',
    ),
);