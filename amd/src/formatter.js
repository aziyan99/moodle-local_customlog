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