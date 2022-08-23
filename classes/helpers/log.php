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
 * local_customlog helper class
 * to store log
 *
 * @package    local_customlog
 * @copyright  2022 rajaazian <${USEREMAIL}>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_customlog\helpers;


use dml_exception;
use RuntimeException;
use stdClass;

defined('MOODLE_INTERNAL') || die;

class log
{

    /**
     * Store the log
     *
     * @param array $messages
     * @return void
     */
    public static function store_log(array $messages): void
    {
        global $DB, $USER;
        try {
            $log = new stdClass();
            $log->timecreated = time();
            $log->relateduserid = $USER->id;
            $log->logs = json_encode($messages);
            $DB->insert_record('cl_store', $log);
        } catch (dml_exception $e) {
            var_dump($e);
            die;
        }
    }

    /**
     * fetch saved log
     *
     * @param $action
     * @param $logid
     * @return mixed|stdClass
     * @throws dml_exception
     */
    public static function fetch_log($action, $logid)
    {
        global $DB;
        if ($action === 'fetch_log') {
            $log = $DB->get_record('cl_store', ['id' => $logid]);
            if (!$log) {
                throw new RuntimeException('Invalid log id');
            }
            return $log;
        }

        throw new RuntimeException('Invalid action');
    }
}