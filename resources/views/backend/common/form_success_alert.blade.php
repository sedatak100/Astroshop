@if (session('success'))
    <script type="text/javascript">
        $(function () {
            require(['GrowlNotification'], function (module) {
                (new module.GrowlNotification({
                    title: '@lang('backend/common.success')',
                    description: '{{ session('success') }}',
                    image: '{{ asset('backend/img/notifications/03.png') }}',
                    type: 'success',
                    position: 'top-center',
                    closeTimeout: 5000
                })).show();
            });
        });
    </script>
@endif