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
                        <h2>Pending Payments</h2>
                        <br>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>COD ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cash_on_deliveries !=null)
                                    @foreach ($cash_on_deliveries as $cash_on_delivery)
                                        @if ($cash_on_delivery->online_status == 'pending' && $cash_on_delivery->type !='on-hand')
                                            <tr>
                                                <th>{{ $cash_on_delivery->id }}</th>
                                                <td>{{ $cash_on_delivery->amount }}</td>
                                                <td>{{ $cash_on_delivery->online_status }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="4">You have no cash_on_delivery</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <br>
                        <h2>Online Payments</h2>
                        <br>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>COD ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cash_on_deliveries !=null)
                                    @foreach ($cash_on_deliveries as $cash_on_delivery)
                                        @if ($cash_on_delivery->online_status == 'received' && $cash_on_delivery->type == 'online')
                                            <tr>
                                                <th>{{ $cash_on_delivery->id }}</th>
                                                <td>{{ $cash_on_delivery->amount }}</td>
                                                <td>{{ $cash_on_delivery->online_status }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="4">You have no cash_on_delivery</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <br>
                        <h2>On Hand Payments</h2>
                        <br>
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>COD ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Verify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cash_on_deliveries !=null)
                                    @foreach ($cash_on_deliveries as $cash_on_delivery)
                                        @if ($cash_on_delivery->type == 'on-hand')
                                            <tr>
                                                <th>{{ $cash_on_delivery->id }}</th>
                                                <td>{{ $cash_on_delivery->amount }}</td>
                                                <td>{{ $cash_on_delivery->online_status }}</td>
                                                <td>
                                                    @if ($cash_on_delivery->verified == 'no')
                                                        <a class="btn btn-sm" href="{{ route('cash_on_delivery.staff_verify', ['cash_on_delivery'=> $cash_on_delivery]) }}">Verify</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
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
