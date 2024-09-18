<?php

namespace App\Helpers;

class ShowModalHelper {
    public static function showModal($buttonClick, $grabContent, $grabDetailModal )
    {
        return
            "
            <script>
            $(document).ready(function () {
            $('#{$buttonClick}').click(function (e) {
                e.preventDefault();

                var urlRoute = $(this).data('url');

                $.ajax({
                    url: urlRoute,
                    method: 'GET',
                    success: function (response) {
                        $('#{$grabContent}').html(response);
                        $('#{$grabDetailModal}').modal('show');
                    },
                    error: function (response) {
                       return 'error';
                    }
                });
            });
            });
            </script>
            ";
    }
}
