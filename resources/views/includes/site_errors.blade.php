@if ($errors->any())
    <div class="notification-box notification-box-error">
        @foreach ($errors->all() as $error)
            <p><i class="icon-remove-sign"></i>{{ $error }}</p>
        @endforeach
		<a href="#" class="notification-close notification-close-error"><i class="icon-remove"></i></a>
    </div>
@endif
