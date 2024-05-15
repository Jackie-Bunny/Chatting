<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chating</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .offline_icon {
            position: absolute;
            height: 15px;
            width: 15px;
            background-color: #252725;
            border-radius: 50%;
            bottom: 0.2em;
            right: 0.4em;
            border: 1.5px solid white;
        }

        .uTabs {
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            background: black;
            color: white;
        }

        .uTabs #sTab {
            width: 40%;
            background: brown;
            text-align: center;
            cursor: pointer;
            padding: 5px;
        }

        .uTabs #gTab {
            width: 40%;
            background: brown;
            text-align: center;
            cursor: pointer;
            padding: 5px;
        }

        .grpIcn {
            width: 40px;
            height: 40px;
            background: blueviolet;
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="{{ asset('css/messenger.css') }}">
    <script src="{{ asset('assets/js/push.min.js') }}"></script>


</head>

<body>

    @php
        $users = DB::table('users')
            ->where('id', '!=', Auth::user()->id)
            ->get();
        // dd($users);
    @endphp
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-md-12 uTabs">
                            <div id="sTab">Single</div>
                            <div id="gTab">Groups</div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <div class="sTab">
                            <ui class="contacts">
                                @foreach ($users as $user)
                                    <li class="user-chat" data-username="{{ $user->name }}"
                                        data-id="{{ $user->id }}" id="userClck" style="cursor: pointer;">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                @if ($user->profile)
                                                    <img src="{{ asset('uploads/users/' . $user->profile) }}"
                                                        class="rounded-circle user_img">
                                                @else
                                                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                        class="rounded-circle user_img">
                                                @endif
                                                @if ($user->status == '1')
                                                    <span class="online_icon"></span>
                                                @endif
                                            </div>
                                            <div class="user_info">
                                                <span>{{ $user->name }}</span>
                                                <p>{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ui>
                        </div>
                        <div class="gTab">
                            <ui class="contacts">
                                @foreach ($users as $user)
                                    <li class="user-chat" data-username="{{ $user->name }}"
                                        data-id="{{ $user->id }}" id="userClck" style="cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between bd-highlight">
                                            <div class="d-flex align-items-center ">
                                                <div class="img_cont">
                                                    @if ($user->profile)
                                                        <img src="{{ asset('uploads/users/' . $user->profile) }}"
                                                            class="rounded-circle user_img">
                                                    @else
                                                        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                            class="rounded-circle user_img">
                                                    @endif
                                                    @if ($user->status == '1')
                                                        <span class="online_icon"></span>
                                                    @endif
                                                </div>
                                                <div class="user_info">
                                                    <span>{{ $user->name }}</span>
                                                    <p>{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <div class="grpIcn">
                                                <i class="fa fa-plus fw-bold"></i>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ui>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 chat chatBody">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="{{ asset('uploads/users/' . Auth::user()->profile) }}"
                                    class="rounded-circle user_img" id="user-profile-image">
                                <span class="offline_icon user-status"></span>
                            </div>
                            <div class="user_info">
                                <span id="user-profile-name">{{ Auth::user()->name }}</span>
                                <p id="user-status">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="video_cam">
                                <span><i class="fas fa-video"></i></span>
                                <span><i class="fas fa-phone"></i></span>
                            </div>
                        </div>
                        <span id="action_menu_btn"><i class="fa fa-sign-out"></i></span>
                    </div>
                    <div class="card-body msg_card_body ">
                        <!-- Receiver's message -->
                        <div class="d-flex justify-content-start rcvMsg mb-4">
                            <div class="img_cont_msg rcvMsg-img">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                Hi, how are you Samim?
                                <span class="msg_time">8:40 AM, Today</span>
                            </div>
                        </div>
                        <!-- Sender's message -->
                        <div class="d-flex justify-content-end sndrMsg mb-4">
                            <div class="msg_cotainer_send">
                                Hi Khalid, I am good. Thanks, how about you?
                                <span class="msg_time_send">8:55 AM, Today</span>
                            </div>
                            <div class="img_cont_msg sndrMsg-img">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                    class="rounded-circle user_img_msg">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                            </div>
                            <input type="hidden" name="reciever_id" id="recieverid" value="">
                            <input type="text" id="messageInput" class="form-control" name="message"
                                placeholder="Type here...">
                            <div class="input-group-append" id="sendMessageButton">
                                <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <div id="user-info" data-name="{{ Auth::user()->name }}"
        data-profile="{{ asset('uploads/users/' . Auth::user()->profile) }}" hidden></div>

    <script type="module" src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            // alert('ok');
            $('.gTab').hide();
            $('.sTab').show();
            $('#sTab').css('background-color', 'green');
            $(document).on('click', '#gTab', function(e) {
                // alert('ok');
                $('.sTab').hide();
                $('.gTab').show();
                $('#gTab').css('background-color', 'green');
                $('#sTab').css('background-color', 'brown');
            });
            $(document).on('click', '#sTab', function(e) {
                $('.sTab').show();
                $('.gTab').hide();
                $('#sTab').css('background-color', 'green');
                $('#gTab').css('background-color', 'brown');
            });
        });
        var authId = @json((string) auth()->user()->id);
        var authProfile = $('#user-info').data('profile');
        var authName = @json(auth()->user()->name);
        var receiverId = $('#recieverid').val();
        var message = $('#messageInput').val();
        window.assetBaseUrl = "{{ asset('') }}";
        var usersUrl = "{{ route('user.get') }}";
        var submitUrl = "{{ route('send-message.post') }}";
        var fetchedUrl = "{{ route('fetch-messages.post') }}";

        console.log('Chat page urls', submitUrl, submitUrl, fetchedUrl);
    </script>

</body>

</html>
