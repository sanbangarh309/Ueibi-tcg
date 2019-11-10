<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
         
          </div>
          <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            @foreach(\App\Modals\MenuList::active()->get() as $menu)
              <li><a href="{{url($menu->url)}}">{{$menu->title}}</a></li>
            @endforeach
              </ul>
            <div id="adminmenu">
                <!-- <admin-menu :items="{{ menu('admin', '_json') }}"></admin-menu> -->
            </div>
            <ul class="nav navbar-nav navbar-right img_menu">
              <li><a href="#"><img src="{{ voyager_asset('images/file.png') }}"></a></li>
              <li><a href="#"><img src="{{ voyager_asset('images/notification.png') }}"></a></li>
              <li><a href="#"><img src="{{ voyager_asset('images/lock.png') }}"></a></li>
              <li><a href="#"><img src="{{ voyager_asset('images/bug.png') }}"></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>