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

use local_customlog\table\customlog_table;

require_once("../../config.php");
require_once("../../lib/tablelib.php");

require_login(0, false);

$CFG->cachejs = false;

$PAGE->set_context(context_system::instance());
$PAGE->set_url("/local/customlog/report_table.php");
$PAGE->navigation->clear_cache();

$PAGE->set_title($SITE->shortname . ": Administration: Plugins:" . get_string('pluginname', 'local_customlog'));
$PAGE->set_heading(get_string('customlog', 'local_customlog'));
$PAGE->navbar->add(get_string('reportpage', 'local_customlog'), new moodle_url('/local/customlog/report_table.php'));

$PAGE->requires->js_call_amd('local_customlog/formatter', 'init', []);

$table = new customlog_table('localcustomlogtable');

echo $OUTPUT->header();

$table->set_sql('*', "{cl_store}", '1=1 order by id desc');
$table->define_baseurl(new moodle_url('/local/customlog/report_table.php'));

$heading = html_writer::tag('h3', get_string('logsdata', 'local_customlog'));
echo html_writer::div($heading);
$table->out(8, true);

echo $OUTPUT->footer();