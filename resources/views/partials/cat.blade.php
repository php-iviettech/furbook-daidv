<div id="list-cats">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Breed name</th>
            <th colspan="3"></th>
        </tr>
        </thead>

        <tbody>
        @foreach($cats as $cat)
            <tr>
                <td><a href="{{route('cats.show', $cat->id)}}">{{$cat->name}}</a></td>
                <td>{{ link_to('cats/breeds/'.$cat->breed->name, $cat->breed->name) }}</td>
                <td>
                    <a href="{{ url('cats/'.$cat->id.'/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                </td>
                <td>
                    <form action="{{ route('cats.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('cart.add', $cat->id) }}" class="btn btn-warning">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(!isset($breed))
        <div class="text-center">
            {{$cats->links()}}
        </div>

        <script type="application/javascript">
            $(function () {
                $('a.page-link').click(function (e) {
                    // Disabled redirect page
                    e.preventDefault();
                    // Get url from attribute href of tag a
                    var url = $(this).attr('href');
                    // Create request
                    $.get(url, function (response) {
                        $('#list-cats').replaceWith(response);
                    });
                    // User load ajax
                    //$('#list-cats').load(url);
                });
            });
        </script>
    @endif

</div>