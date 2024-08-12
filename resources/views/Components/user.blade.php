<div id="user-list">
    @if(isset($users))
    @php $count_loop = 0; @endphp
    @foreach ($users as $user)
    <ul id="{{ $user->id }}">{{ $user->fname }}</ul>
    @php
    $count_loop++;
    if ($count_loop >= 3) break;
    @endphp
    @endforeach
    @else
    <p>No users found.</p>
    @endif
</div>