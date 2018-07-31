<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right" style="margin: 10px;">
                <li role="presentation" class="active"><a href="/">Home</a></li>
                <li role="presentation"><a href="#">About</a></li>
                <li role="presentation"><a href="#">Contact</a></li>
                <li role="presentation" class="dropdown">
                    <a class="ropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span
                                class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        @if (\Illuminate\Support\Facades\Auth::guest())
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li><a href="{{route('register')}}">Register</a></li>
                        @else
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>