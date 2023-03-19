<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajaxposts.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewPost').click(function() {
            $('#savedata').val("create-post");
            $('#id').val('');
            $('#postForm').trigger("reset");
            $('#modelHeading').html("Create New Post");
            $('#ajaxModelexa').modal('show');
        });

        $('body').on('click', '.editPost', function() {
            var id = $(this).data('id');
            $.get("{{ route('ajaxposts.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit Post");
                $('#savedata').val("edit-user");
                $('#ajaxModelexa').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#description').val(data.description);
            })
        });

        $('#savedata').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#postForm').serialize(),
                url: "{{ route('ajaxposts.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    $('#postForm').trigger("reset");
                    $('#ajaxModelexa').modal('hide');
                    // table.draw();
                    table.row( this ).remove().draw( false );
                    $('#savedata').html('Save Post');
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#savedata').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deletePost', function() {

            var id = $(this).data("id");
            confirm("Are You sure want to delete this Post!");

            $.ajax({
                type: "DELETE",
                url: "{{ route('ajaxposts.store') }}" + '/' + id,
                success: function(data) {
                    // table.draw();
                    table.row( this ).remove().draw( false );
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>
{{-- @endsection --}}
