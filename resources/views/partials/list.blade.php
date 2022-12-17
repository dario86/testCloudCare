<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>{{ __('custom.name') }}</th>
            <th>{{ __('custom.description') }}</th>
        </tr>
        @foreach($data as $row)
            <tr>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['description'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
