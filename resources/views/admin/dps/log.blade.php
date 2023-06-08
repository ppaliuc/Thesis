@extends('layouts.admin')

@section('content')

<div class="card">
	<div class="d-sm-flex align-items-center justify-content-between">
	<h5 class=" mb-0 text-gray-800 pl-3">{{ __('Dps Logs of') }} <span class="text-info">{{ $dps->transaction_no}}</span></h5>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.loan.index') }}">{{ __('Loans') }}</a></li>
	</ol>
	</div>
</div>


<div class="row mt-3">
  <div class="col-lg-12">

	@include('includes.admin.form-success')

	<div class="card mb-4">
	  <div class="table-responsive p-3">
		<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
		  <thead class="thead-light">
			<tr>
				<th>{{__('Serial No')}}</th>
				<th>{{__('Date')}}</th>
				<th>{{__('Amount')}}</th>
			</tr>
		  </thead>

          <tbody>
              @foreach ($logs as $key=>$data)
                <tr>
                    <td><span class="text-info">{{ $loop->iteration }}</span></td>
                    <td>{{ $data->created_at->toDateString()}}</td>
                    <td>{{$currency->sign}} {{$data->amount}}</td>
                </tr>
              @endforeach
          </tbody>
		</table>
	  </div>
      {{ $logs->links() }}
	</div>
  </div>
</div>


@endsection


@section('scripts')

@endsection


