@extends(Gate::allows('permissions') ? 'layouts.app' : 'layouts.customer')

@section('content')
<div>
    @if(Gate::allows('permissions'))
    <h2>Admin Dashboard</h2>
@else
    <h2>Customer Dashboard</h2>
@endif

    <h2></h2>
</div>
@endsection
