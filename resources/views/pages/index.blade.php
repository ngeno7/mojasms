@extends('layout')

@section('main-content')
<div class="row mt-4">
    <div class="col-12 text-end">
        <button 
            data-bs-toggle="modal" data-bs-target="#sendMessageModal"
            class="btn btn-sm btn-secondary">Send Message</button>
    </div>
    @include('pages.modals.send-sms')
</div>
<h5>Sent Messages History</h5>
<div class="table-responsive">
    <table class="table table-sm">
      <thead class="bg-light">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Message</th>
          <th scope="col">Sent At</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($smses as $sms)
          <tr>
            <td>{{ $sms->message_id }}</td>
            <td>{{ $sms->message}}</td>
            <td>{{ $sms->sent_at}}</td>
            <td>{{ $sms->delivery_status ?? '-'}}</td>
          </tr>  
          @endforeach
      </tbody>
    </table>
</div>
@endsection
