<?php

namespace App\Helpers;

class CreateModalHelper{

    public static function createModalHelper(
        $formSaveName, $confirmationModal, $detailModal, $cancelSubmit, $confirmSubmit, $routeUrl)
    {
        return
            "
            <script>
                    $(document).ready(function(){
                        $('#{$formSaveName}').on('submit', function(e){
                            e.preventDefault();

                            var dataInput = new FormData(this);

                            $('#{$confirmationModal}').modal('show');

                            $('#{$confirmationModal}').on('shown.bs.modal', function () {
                                $('#{$detailModal}').css('z-index',1049);
                            });

                            $('#{$cancelSubmit}').click(function() {
                                $('#{$confirmationModal}').modal('hide');
                                $('#{$detailModal}').css('z-index',1055);
                            });


                            $('#{$confirmSubmit}').click(function (){
                                $.ajax({
                                    url: '/{$routeUrl}',
                                    method: 'POST',
                                    data: dataInput,
                                    contentType: false, // Jangan kirim contentType
                                    processData: false, // Jangan proses data
                                    success: function (response){

                                        // Menghitung jumlah .page-item kecuali yang disable
                                        var totalPages = $('.pagination .page-item:not(.disabled)').length;

                                        // Mendapatkan halaman saat ini
                                        var currentPage = parseInt($('.pagination .page-item.active').text(), 10);

                                        // Mendapatkan nomor halaman terakhir dari elemen kedua terakhir
                                        var lastPage = totalPages - 2;

                                        // Mendapatkan nomor halaman kedua terakhir
                                        var secondLastPage = lastPage - 2;

                                        if (currentPage === lastPage || currentPage === secondLastPage) {

                                            $('#table-responsive').html(response.newItem);
                                        } else {

                                            location.reload();
                                        }

                                      $('#{$confirmationModal}').modal('hide');
                                      $('#{$detailModal}').modal('hide');
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.responseText);
                                    }
                                });
                            });
                        });
                    });

            </script>
            ";
    }
}
