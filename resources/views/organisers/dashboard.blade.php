<x-organiser-layout>
    @section('title', "Manager")
    <div id="titlebar">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ auth()->user()->name ?? "" }}  {{ auth()->user()->lastName ?? "" }}</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('organiser.index') }}">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        @include('organisers.components._stat', [
            'number' => \App\Models\Event::query()->where('user_id', '=', auth()->id())->count(),
            'name' => "Evénement",
            'icon' => 'im-icon-Clothing-Store',
            'color' => 'color-1'
        ])

        @include('organisers.components._stat', [
            'number' => 0,
            'name' => "Billing",
            'icon' => 'im-icon-Money-2',
            'color' => 'color-2'
        ])

        @include('organisers.components._stat', [
            'number' => 0,
            'name' => "Images",
            'icon' => 'im-icon-Cloud-Picture',
            'color' => 'color-3'
        ])
    </div>

    <div class="row margin-bottom-30">
        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box invoices with-icons margin-top-20">
                <h4>Payout History</h4>
                <canva
                    class="sales-overview-chart chartjs-render-monitor"
                    id="canvas"></canva>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="dashboard-list-box invoices with-icons margin-top-20">
                <h4>Invoices</h4>
                <ul>
                    @foreach($payments as $payment)
                        <li>
                            <i class="list-box-icon sl sl-icon-doc"></i>
                            <strong>{{ $payment->event->title ?? "" }}</strong>
                            <ul>
                                <li class="unpaid">{{ $payment->event->payment ?? "" }}</li>
                                <li>Order: #{{ $payment->reference }}</li>
                                <li>Date: {{ $payment->created_at->format('Y-mm-d') }}</li>
                            </ul>
                            <div class="buttons-to-right">
                                <a href="dashboard-invoice.html" class="button gray">View Invoice</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            $(function(){
                let cData = JSON.parse(``);
                let ctx = $("#canvas");

                let data = {
                    labels: cData.label,
                    datasets: [
                        {
                            label: "Reservations",
                            data: cData.data,
                            backgroundColor: [
                                "#5ce0aa",
                                "#A9A9A9",
                                "#DC143C",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#5ce0aa",
                            ],
                            borderColor: [
                                "#5ce0aa",
                                "#989898",
                                "#CB252B",
                                "#E39371",
                                "#1D7A46",
                                "#5ce0aa",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1,1,1]
                        }
                    ]
                };

                let chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.labels,
                        datasets: data.datasets
                    },
                    options: {
                        legend: {
                            display: data.legend ? data.legend : false,
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                fontColor: '#6783b8'
                            }
                        },
                        scales: {
                            myScale: {
                                type: 'logarithmic',
                                position: 'right',
                            }
                        }
                    }
                });
            });
        </script>
    @endsection

</x-organiser-layout>
