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
 * Handle modal toggle and
 * format the logs
 *
 * @copyright  2022 rajaazian <rajaazian08@gmai.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'core/modal_factory', 'core/templates',
    'core/config', 'core/notification', 'core/ajax',
    'core/str'], function ($, ModalFactory,
                           Templates, mdlcfg,
                           notification, ajax,
                           str) {
    return {
        init: function () {
            $(document).on('click', '.customlog-showlog', function () {
                ajax.call([{
                    methodname: 'local_customlog_fetch_log',
                    args: {logid: parseInt($(this).data('id'))},
                    done: function (res) {
                        var logs = JSON.stringify(JSON.parse(res.logs), null, 4);

                        ModalFactory.create({
                            type: ModalFactory.types.DEFAULT,
                            title: str.get_string('logdetails', 'local_customlog', '', 'en')
                                .then(function (s) {
                                    return s;
                                }).catch(notification.exception),
                            body: `<pre style="color: green; font-size: 12px;">${logs}</pre>`,
                        }).then(function (modal) {
                            modal.show();
                        });
                    },
                    fail: notification.exception
                }]);
            });
        }
    };
});