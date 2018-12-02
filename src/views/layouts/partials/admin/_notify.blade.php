
<div class="wrapper--fluid">
    @if (session('success'))
        <div class="notify notify--success notify__dismissable">{!! session('success')  !!} </div>
    @endif

    @if(session('danger'))
        <div class="notify notify--danger notify__dismissable">{!! session('danger') !!}</div>
    @endif

    @if(session('warning'))
        <div class="notify notify--warning notify__dismissable">{!! session('warning') !!}</div>
    @endif

    @if(session('info'))
        <div class="notify notify--info notify__dismissable">{!! session('info') !!}</div>
    @endif

</div>


