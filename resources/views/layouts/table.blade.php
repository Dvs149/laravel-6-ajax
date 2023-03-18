<table class="table table-striped data-table">
    <thead>
        <tr>
            @foreach ($table as $val)
            <th>{{$val}}</th>    
            @endforeach
            {{-- <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th width="280px">Action</th> --}}
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>