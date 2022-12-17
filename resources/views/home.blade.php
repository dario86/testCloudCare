<!DOCTYPE html>
<html>
<head>
    <title>Laravel Pagination using Ajax</title>
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
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link page-prev" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link page-next" href="#">Next</a></li>
        </ul>
    </nav>

</div>
</body>
</html>

<script>
    $(document).ready(function(){

        var page = 1;
        var per_page = 10;

        $(document).on('click', '.page-prev', function(event){
            page <= 1 ? page : page--;
            fetch_data(page);
        });

        $(document).on('click', '.page-next', function(event){
            page++;
            fetch_data(page);
        });

        function fetch_data(page)
        {
            $.ajax({
                url:"/api/list?token="+'{{ $token }}'+"&page="+page+"&perPage="+per_page,
                success:function(data)
                {
                    if (data.success) {
                        $('#table_data').html(data.html);
                    }
                    else {
                        alert('error occurred');
                    }
                }
            });
        }

        fetch_data(1);

    });
</script>
