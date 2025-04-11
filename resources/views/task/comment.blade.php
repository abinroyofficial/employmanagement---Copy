<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment Modal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <style>
        .d-flex {
            gap: 5px;
        }

        .card-text {
            color: black;
        }

        body {
            font-family: "Times New Roman", serif;
        }

        .comment-list {
            max-height: 300px;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .comment-list::-webkit-scrollbar {
            display: none;
        }

        .form-control {
            width: 200px;
        }

        #edit_comment_input {
            width: 100%
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="comment-list">
            @foreach ($comment as $cmt)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        @include('components.comment-thread', ['comment' => $cmt, 'level' => 0])
                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="edit_Form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="comment_id" id="comment_id">
                        <div class="form-group">
                            <label for="edit_comment_input">Comment</label>
                            <input type="text" name="edit_comment" id="edit_comment_input" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Comment</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".btn-edit").click(function() {
                var comment_id = $(this).val();

                $.ajax({
                    url: '/show_comment',
                    method: 'GET',
                    data: {
                        comment_id: comment_id
                    },
                    success: function(response) {
                        if (response.comment_data) {
                            $("#edit_comment_input").val(response.comment_data);
                            $("#comment_id").val(response.comment_id);
                            $('#modalForm').modal('show');
                        }
                    },
                    error: function() {
                        alert("Error loading comment.");
                    }
                });
            });


            $("#edit_Form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/update_comment',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {

                        $('#modalForm').modal('hide');
                        location.reload();
                    },
                    error: function() {
                        alert("Failed to update comment.");
                    }
                });
            });



        });
    </script>


    <script>
        $(document).ready(function() {
            $(".btn-reply").click(function() {
                const id = $(this).data("id");
                $("#reply-form-" + id).show();
            });

            $(".cancel-reply").click(function() {
                const id = $(this).data("id");
                $("#reply-form-" + id).hide();
            });

            $(".submit-reply").click(function() {
                const id = $(this).data("id");
                const replyText = $("#reply-text-" + id).val();
                const taskId = $('#task-id').text();

                $.ajax({
                    url: '/reply_comment',
                    method: 'POST',
                    data: {
                        comment_id: id,
                        reply_comment: replyText,
                        task_id: taskId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Failed to submit reply.");
                    }
                });
            });
        });
    </script>


</body>

</html>
