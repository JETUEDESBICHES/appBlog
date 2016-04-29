<div class="container">

     <ul class="nav navbar-nav navbar-right">
	    <!-- Authentication Links -->
	    @if (Auth::guest())
	        <li><a href="{{ url('/login') }}">Login</a></li>
	        <li><a class="btn-default" href="{{ url('/register') }}">Identifier</a></li>
	    @else
	    	<li><a href="{{ url('/') }}"><i class="fa fa-coffee" aria-hidden="true"></i> Blog</a></li>
			 <li><a href="{{ url('/post/create') }}"><i class="fa fa-plus-circle"></i> Créer un article</a></li>
	        <li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                {{ Auth::user()->name }} <span class="caret"></span>
	            </a>

	            <ul class="dropdown-menu" role="menu">

					<li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Deconexion</a></li>

	            </ul>
	        </li>
	    @endif
	</ul>

</div>