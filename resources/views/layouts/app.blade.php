<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/52acb2c308.js" crossorigin="anonymous"></script>
    {{-- s:firebase fcm --}}
    <script src="https://www.gstatic.com/firebasejs/7.11.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.11.0/firebase-messaging.js"></script>
    <link rel="manifest" href="manifest.json">
    {{-- e:firebase fcm --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-bell fa-lg text-info"></i><sup class="badge badge-success notification-count" id="notification_count">{{isset($notificationCount)? $notificationCount:0}}</sup>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right bg-dark" 
                                aria-labelledby="navbarDropdown"
                                style="overflow-y: scroll;min-height:200px;"
                                id="notification_list"
                                >
                                @if ($notifications && count($notifications) > 0)
                                    @foreach ($notifications as $notify)
                                    <a class="dropdown-item text-white" uid="{!! $notify->id !!}" href="jaavascript:;"
                                       >
                                        <span >{{$notify->data['message']}}</span>
                                        <sub>{{ $notify->created_at->diffForHumans() }}</sub>
                                    </a>
                                        
                                    @endforeach
                                @endif
\
                           
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- s:firebase fcm --}}

    <script src="{{asset('firebase.js')}}"></script>
    <script>
        //   Initialize Firebase
firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();
     messaging.usePublicVapidKey("keykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykeykey");

    messaging.requestPermission()
    .then(function(){
        console.log('genrated no permission');
        return messaging.getToken();
    })
    .then(function(token){
        console.log(token);
        $.ajax({
                    url: "{{ route('user.save_fcm_token') }}",
                    type: 'POST',
                    data: {
                        fcm_token: token ,_token:'{{csrf_token()}}'
                    },
                    dataType: 'JSON',
                    success: function (res) {
                    },
                    error: function (err) {
                        console.log(" Can't do because: " + err);
                    },
                });
    })
    .catch(function(error){
        console.log("error");
        console.log(error);
    });

    messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    play(payload.notification);
    var notify_input = document.getElementById('notification_count');
     var notify_count = parseInt(notify_input.innerHTML);
     notify_count = notify_count +1;
     notify_input.innerHTML = notify_count;

     var noteTitle = payload.notification.title;
     var noteData = JSON.parse(payload.data.fcmapp);
      var ul = document.getElementById("notification_list");
      var li = `
      <a uid="${noteData.id}" 
      href="jaavascript:;" class="dropdown-item text-white">
      <span>${noteData.message}</span> 
      <sub>${noteData.created_at}</sub>
      </a>
      `;
     $("#notification_list").prepend(li);
    });
    function play(n) {

    options = {
    'body' : n.body,
    'icon' : n.icon,
    'silent' : 'false',
    'sound' : 'inflicted.ogg'
    }

    var notification = new Notification(n.title, options);
    }
    </script>
    {{-- e:firebase fcm --}}


</body>
</html>