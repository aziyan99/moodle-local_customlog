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

namespace local_customlog\table;

use table_sql;

class customlog_table extends table_sql
{

    /**
     * Constructor
     * @param int $uniqueid all tables have to have a unique id, this is used
     *      as a key when storing table properties like sort order in the session.
     */
    function __construct($uniqueid)
    {
        parent::__construct($uniqueid);
        // Define the list of columns to show.
        $columns = array('relateduserid', 'timecreated', 'logs');
        $this->define_columns($columns);

        // Define the titles of columns to show in header.
        $headers = array('Initiator', 'Time Created', 'Logs');
        $this->define_headers($headers);
    }

    function col_timecreated($values)
    {
        return '<span>' . date('d M y H:i:s', $values->timecreated) . '</span>';
    }

    function col_logs($values)
    {
        $deletebutton = '<a href="javascript:void(0);" class="text-primary" role="button" data-id="' . $values->id . '"><i class="icon fa fa-trash fa-fw"></i></a>';
        return '<a href="javascript:void(0);" class="customlog-showlog text-primary" role="button" data-id="' . $values->id . '"><i class="icon fa fa-search fa-fw"></i></a>' . $deletebutton;
    }

    function col_relateduserid($values)
    {
        global $DB;
        $user = $DB->get_record('user', ['id' => $values->relateduserid]);
        if (!$user) {
            return '<a href="javascript:void(0);">' . get_string('userunavailable', 'local_customlog') . '</a>';
        }

        return '<a href="/user/profile.php?id=' . $user->id . '">' . $user->firstname . " " . $user->lastname . '</a>';
    }
}