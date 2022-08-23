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
 * local_customlog table modifier.
 *
 * @package local_customlog
 * @copyright  2022 rajaazian <rajaazian08@gmai.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * EditPDF upgrade code
 * @param int $oldversion
 * @return bool
 */
function xmldb_local_customlog_upgrade($oldversion)
{
    global $CFG, $DB;

    $dbman = $DB->get_manager();
    if ($oldversion < 2022081905) {

        // Define field relateduserid to be added to cl_store.
        $table = new xmldb_table('cl_store');
        $field = new xmldb_field('relateduserid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '-1', 'id');

        // Conditionally launch add field relateduserid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Customlog savepoint reached.
        upgrade_plugin_savepoint(true, 2022081905, 'local', 'customlog');
    }
    return true;
}