<?php

namespace App\Helpers;


class AjaxPaginationHelper {
    public static function script($containerId, $urlRoute) {
        return "
       <script>
            $(document).ready(function() {
                $(document).on('click', '.pagination a', function (e){
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    fetchData(page);
                    urlBack = '{$urlRoute}';

                })
            })
            function fetchData(page) {
                $.ajax({
                url : '{$urlRoute}'+page,
                method: 'GET',
                success: function(response) {
                    $('#{$containerId}').html(response);
                },
                error: function(response){
                    return 'Error';
                }
                })
            }
       </script>
            ";
    }
}
