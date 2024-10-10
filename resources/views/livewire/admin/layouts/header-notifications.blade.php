<li class="onhover-dropdown" wire:poll.10000ms>
    <div class="notification-box"><i data-feather="bell"></i><span class="dot-animated"></span></div>
    <ul class="notification-dropdown onhover-show-div">

        <li>
            <p class="f-w-700 mb-0"> لديك  {{$notifications->count()}} إشعار<span
                    class="pull-right badge badge-primary badge-pill">{{$notifications->count()}}</span>
            </p>
        </li>

        @foreach($notifications as $notification)
        <li class="noti-primary">
            <div class="media">
               <a href=""{{route('admin.notifications')}}""> <span class="notification-bg bg-light-secondary"><i data-feather="check"></i></span> <a/>
                <div class="media-body">
                    <a href="{{route('admin.notifications')}}" class="onhover-dropdown">
                        <i class="noti-primary"></i> {{$notification->title}}
                        <span>{{($notification = \App\Models\Notification::orderBy('id','DESC')->first()) ? $notification->created_at->diffForHumans() : ""}}</span>
                    </a>
                </div>
            </div>
        </li>
        @endforeach


    </ul>
</li>


