@if ($admin)
NEW Confession wait for approve
{{ action('ListController@index') }}
@else
TO ALL >>>
@endif
[info][title]New Confession @if($confession->name && trim($confession->name))from {{ trim($confession->name) }} @endif {{ '(inlove)' }} ※ Added at: {{ $confession->created_at }}[/title]{{ $confession->content }}[/info]