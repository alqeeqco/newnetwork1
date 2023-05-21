@extends('layouts.front_layout')

@section('title', 'Account')

@section('content')
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="tab-content">
                    <div class="tab-pane fade active show">
                        <div class="axil-dashboard-order">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        @foreach ($Tracking->Tracking[0] as $k => $key)
                                            <th scope="">{{ $k }}</th>
                                        @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($Tracking->Tracking[0] as $k => $key)
                                            <td>{{ $key }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
