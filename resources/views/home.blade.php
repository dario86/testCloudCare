<!DOCTYPE html>
<html>
<head>
    <title>Test Cloud Care</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
        }
    </style>
</head>
<body>
<br />
<div class="container">
    <div id="table_data">
        <div class="table-responsive">
        </div>
    </div>
    <nav>
        <ul class="pagination pull-right">
            <li class="page-item"><a class="page-link page-prev" href="#">{!! __('pagination.previous') !!}</a></li>
            <li class="page-item"><a class="page-link page-next" href="#">{!! __('pagination.next') !!}</a></li>
        </ul>
    </nav>

</div>
</body>
</html>

<script>
    $(document).ready(function(){

        var page = 1;
        var per_page = 10;

        function fetch_data(page)
        {
            $.ajax({
                url:"/api/list",
                data: {
                    token: '{{ $token }}',
                    page: page,
                    perPage: per_page,
                },
                success:function(data)
                {
                    if (data.success) {
                        $('#table_data').html(data.html);
                    }
                    else {
                        alert('error occurred');
                    }
                },
                error: function(error) {
                    alert('error occurred');
                }
            });
        }

        $(document).on('click', '.page-link', function(event){

            if($(event.target).hasClass('page-prev')) {
                page <= 1 ? page : page--;
            }

            if($(event.target).hasClass('page-next')) {
                page++;
            }

            fetch_data(page);
        });

        fetch_data(1);

    });
</script>
