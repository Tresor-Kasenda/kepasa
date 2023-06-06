<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <title>Billet d'evenement</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="" href="https://fonts.googleapis.com/css?family=Arvo">
    <meta charset="utf-8">
    <style>
        body {
            background-color: #fff;
            font-family: Arvo, sans-serif !important;
            font-weight: 200 !important;
        }

        .ticket {
            font-family: Arvo, sans-serif !important;
            background-repeat: no-repeat;
            background-position: top;
            background-size: 100%;
            background-color: #fff;
            width: 900px;
            height: 400px;
            border-radius: 15px;
            -webkit-filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            display: block;
            margin: 10% auto auto auto;
            color: #fff;;
        }

        .date {
            margin: 15px;
            -webkit-filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
        }

        .date .day{
            font-size: 80px;
            float: left;
        }

        .date .month-and-time {
            float: left;
            margin: 15px 0 0 0;
            font-weight: 200;
        }

        .artist {
            font-size: 30px;
            margin: 10px 100px 0 40px;
            float: left;
            font-weight: 200;
            -webkit-filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
        }

        .rip {
            border-right: 10px solid transparent;
            padding: 5px;
            background-image: url({{ asset('images/line3.png') }});
            height: 400px;
            position: absolute;
            top: 0;
            left: 600px;
        }

        .cta {
            font-family: Arvo, sans-serif !important;
            position: absolute;
            top: 50%;
            right: 15px;
            display: block;
            font-size: 10px;
            font-weight: 200;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            text-decoration: none;
            -webkit-filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
        }

        .cta2 {
            font-family: Arvo, sans-serif !important;
            position: absolute;
            top: 60%;
            right: 15px;
            display: block;
            font-size: 10px;
            font-weight: 200;
            padding: 10px 20px;
            border-radius: 25px;
            color: #fff;
            text-decoration: none;
            -webkit-filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
            filter: drop-shadow(1px 1px 3px rgba(0, 0, 0, 0.3));
        }

        .small {
            font-weight: 200;
            font-size: 20px;
        }

        .ticket-1 {
            background-image: url({{ asset('images/ticket.jpeg') }});
            border-radius: 15px;
        }

        .artist{
            height: 100%;
            margin-top: 3rem;
            display: block;
        }

        .venue{
            position: absolute;
            bottom: 3rem;
        }

        .artist div{
            margin-bottom: 1rem;
        }

        .time{
            padding-top: 2rem !important;
        }

        .time span{
            float: right;
            padding-right: 4rem;
        }

        .qr .logo{
            margin-top: -10%;
            position: absolute;
            bottom: 1rem;
            left: 1rem;
        }

        .logo2 #logo{
            height: 9rem;
            width: 8rem;
            position: absolute;
            bottom: 1rem;
            right: 1rem;
        }

        .name{
            font-size: 20px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

</head>
<body onload="script();">
    <div >
        <div class="ticket ticket-1" id="wrapper_tickets">
            <div class="date">
                <span class="day">{{ date('d', strtotime($invoice->event->date)) }}</span>
                <span class="month-and-time">{{ date('m', strtotime($invoice->event->date)) }}<br>
                    <span class="small">{{ date('Y', strtotime($invoice->event->date)) }}</span>
                </span>
            </div>
            <div class="artist">
                <div>
                    <span class="name">Event Name: {{ strtoupper($invoice->event->title) }}</span>
                </div>
                <div>
                    <span class="live small">TICKET #:{{ $invoice->reference }}</span>
                </div>
                <div class="location">
                    <div class="venue">
                        <div>
                            <span class="small">{{ $invoice->event->city }}</span>
                        </div>
                        <div>
                            <span class="small">
                                <span>Address: {{ $invoice->event->address }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rip"></div>
            <div class="time">
                <span>Time: {{ substr($invoice->event->startTime,0,5) }}</span>
            </div>
            <div class="cta">
                <span class="small">Ticket Holder:</span><br>
                <span class="small">{{ ucfirst(auth()->event()->name) }}  {{ ucfirst(auth()->event()->lastName) }}</span>
            </div>
            <div class="cta2">
                <span class="small"></span>
            </div>
            <div class="qr">
                <span class="logo">
                    {!! DNS2D::getBarcodeHTML($invoice->reference, 'QRCODE')!!}
                </span>
            </div>
            <div class="logo2">
                <img src="{{ asset('images/logo3.png') }}" id = "logo">
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                let doc = new jsPDF('p', 'pt', 'a4',false );
                doc.addHTML(document.getElementById("wrapper_tickets"), function () {
                    let ticket  = `${Math.floor(Math.random() * 8)+".pdf"}`
                    doc.save(ticket)
                });
            });
        </script>
    </div>
</body>
</html>

