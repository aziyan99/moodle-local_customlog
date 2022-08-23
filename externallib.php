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
 * local_customlog web service process.
 *
 * @package local_customlog
 * @copyright  2022 rajaazian <rajaazian08@gmai.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/externallib.php");

class local_customlog_external extends external_api
{
    public static function fetch_log_parameters()
    {
        return new external_function_parameters(
            array(
                'logid' => new external_value(PARAM_INT, 'The id of log')
            )
        );
    }

    public static function fetch_log($logid)
    {
        global $DB;

        $params = self::validate_parameters(self::fetch_log_parameters(), ['logid' => $logid]);

        $log = $DB->get_record('cl_store', ['id' => $params['logid']]);
        if (!$log) {
            throw new invalid_parameter_exception('Invalid log id');
        }

        $result = array();
        $result['logid'] = $log->id;
        $result['timecreated'] = $log->timecreated;
        $result['logs'] = $log->logs;
        return $result;
    }

    public static function fetch_log_returns()
    {
        return new external_single_structure(
            array(
                'logid' => new external_value(PARAM_INT, 'The id of log'),
                'timecreated' => new external_value(PARAM_INT, 'The created time'),
                'logs' => new external_value(PARAM_TEXT, 'The logs')
            )
        );
    }

}