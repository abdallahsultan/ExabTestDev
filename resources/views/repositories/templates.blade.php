<script>
        $(document).ready(function() {
            var table = $('#repositoriesTable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    "url": '{{ route("repositories.fetch") }}',
                    "data": function(d) {
                        d.date = $('#dateSearch').val();
                        d.language = $('#languageSearch').val();
                    }
                },
                "columns": [
                    { "data": "name", "sortable": false },
                    { "data": "description" , "sortable": false },
                    { "data": "stargazers_count", "sortable": false },
                    { "data": "language", "sortable": false },
                    { "data": "html_url", "sortable": false, "render": function(data) { return '<a href="' + data + '" target="_blank">View on GitHub</a>'; } }
                ],
                order: [[2, 'desc']]

            });

            $('#filterForm').on('submit', function(e){
                e.preventDefault();
                table.ajax.reload();
            });

            // Export button click event
            $('#exportButton').on('click', function() {
                let tableInfo = table.page.info();
                $.ajax({
                    url: '{{ route("repositories.export") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        date: $('#dateSearch').val(),
                        language: $('#languageSearch').val(),
                        length: tableInfo.length,
                        start: tableInfo.start
                    },
                    success: function(response) {
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            html: `
                              You can download the Excel file using  
                              <a href="http://localhost:8025/" target="_blank" autofocus> the link</a>,
                              
                            `,
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: `<i class="fa fa-thumbs-up"></i> Great!`,
                            confirmButtonAriaLabel: "Thumbs up, great!",
                            cancelButtonText: `<i class="fa fa-thumbs-down"></i>`,
                            cancelButtonAriaLabel: "Thumbs down"
                        });
                        // Swal.fire(
                        //     'Export Completed!',
                        //     response.message,
                        //     'success'
                        // );
                    }
                });
            });
        });
    </script>