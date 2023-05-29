<x-app-layout>
    @section('title', "Administration Kepasa")

    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title page-title">Administration</h4>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row g-gs">
                    @include('admins.partials.stats', [
                        'username' => "Users",
                        'amount' => \App\Models\User::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Events",
                        'amount' => \App\Models\Event::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Organisers",
                        'amount' => \App\Models\Company::count()
                    ])
                    @include('admins.partials.stats', [
                        'username' => "Billings",
                        'amount' => \App\Models\Billing::count()
                    ])
                </div>
                <div class="row  g-gs">
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="card-inner">
                                <div>
                                    <canvas
                                            class="sales-overview-chart chartjs-render-monitor"
                                            id="canvas"
                                    ></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script>
            $(function(){
                let cData = JSON.parse();
                let ctx = $("#canvas");

                let data = {
                    labels: cData.label,
                    datasets: [
                        {
                            label: "Users Count",
                            data: cData.data,
                            backgroundColor: [
                                "#DEB887",
                                "#A9A9A9",
                                "#DC143C",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#CDA776",
                            ],
                            borderColor: [
                                "#CDA776",
                                "#989898",
                                "#CB252B",
                                "#E39371",
                                "#1D7A46",
                                "#F4A460",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1,1,1]
                        },
                        {
                            label: "Users Count",
                            data: cData.data,
                            backgroundColor: [
                                "#DEB887",
                                "#A9A9A9",
                                "#DC143C",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#CDA776",
                            ],
                            borderColor: [
                                "#CDA776",
                                "#989898",
                                "#CB252B",
                                "#E39371",
                                "#1D7A46",
                                "#F4A460",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1,1,1]
                        },
                        {
                            label: "Users Count",
                            data: cData.data,
                            backgroundColor: [
                                "#DEB887",
                                "#A9A9A9",
                                "#DC143C",
                                "#F4A460",
                                "#2E8B57",
                                "#1D7A46",
                                "#CDA776",
                            ],
                            borderColor: [
                                "#CDA776",
                                "#989898",
                                "#CB252B",
                                "#E39371",
                                "#1D7A46",
                                "#F4A460",
                                "#CDA776",
                            ],
                            borderWidth: [1, 1, 1, 1, 1,1,1]
                        }
                    ]
                };

                var options = {
                    responsive: true,
                    title: {
                        display: true,
                        position: "top",
                        text: "Last Week Registered Users -  Day Wise Count",
                        fontSize: 18,
                        fontColor: "#111"
                    },
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            fontColor: "#333",
                            fontSize: 16
                        }
                    }
                };

                let chart1 = new Chart(ctx, {
                    type: "pie",
                    data: data,
                    options: options
                });
            });
        </script>
    @endsection
</x-app-layout>
