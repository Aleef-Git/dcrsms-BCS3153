<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cash On Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        @if (session()->has('success_message'))
                            <div class="spacer"></div>
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="spacer"></div>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h2>Pending Payments</h2>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>COD ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cash_on_deliveries !=null)
                                    @foreach ($cash_on_deliveries as $cash_on_delivery)
                                    <tr>
                                        <th>{{ $cash_on_delivery->id }}</th>
                                        <td>{{ $cash_on_delivery->amount }}</td>
                                        <td>{{ $cash_on_delivery->online_status }}</td>
                                        <td>
                                            @if (Auth::user()->hasRole('rider') && $cash_on_delivery->online_status != 'received')
                                                <a class="btn btn-sm" href="{{ route('cash_on_delivery.online_verify', ['cash_on_delivery'=> $cash_on_delivery]) }}">Online</a>
                                            @endif
                                            @if (Auth::user()->hasRole('rider') && $cash_on_delivery->online_status != 'received')
                                                <a class="btn btn-sm" href="{{ route('cash_on_delivery.rider_verify', ['cash_on_delivery'=> $cash_on_delivery]) }}">On Hand</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="4">You have no cash_on_delivery</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
