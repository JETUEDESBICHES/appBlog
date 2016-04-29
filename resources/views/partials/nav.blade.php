<div class="container">

     <ul class="nav navbar-nav">
		
		<li><a href="{{ url('/') }}"><i class="fa fa-coffee" aria-hidden="true"></i>
				 Blog</a></li>

		 @forelse($categories as $id => $title)
			@if($title === 'conférence')
				 <li><a href="{{ Action('FrontController@showPostByCat', $id)}}"><i class="fa fa-wpforms" aria-hidden="true"></i> {{$title}}</a></li>

		 @else
				<li><a href="{{ Action('FrontController@showPostByCat', $id)}}"><i class="fa fa-bullhorn" aria-hidden="true"></i> {{$title}}</a></li>
			 @endif
	    @empty
	    @endforelse
	</ul>

	<ul class="nav navbar-nav navbar-right">
	    <!-- Authentication Links -->
	    @if (Auth::guest())
	        <li><a href="{{ url('/login') }}">Login</a></li>
	        <li><a class="btn-default" href="{{ url('/register') }}">Identifier</a></li>
	    @else
	        <li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
	                {{ Auth::user()->name }} <span class="caret"></span>
	            </a>

	            <ul class="dropdown-menu" role="menu">
					<li><a href="{{ url('/post') }}"><i class="fa fa-briefcase"></i> Admin</a></li>
	                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Deconexion</a></li>
	            </ul>
	        </li>
	    @endif
	</ul>

</div>

