<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} | </title>
    <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}">
</head>

<body>
    <a href="javascript:window.print()" class="print-button">Print this invoice</a>
    <div id="invoice">
        <div class="row">
            <div class="col-md-6">
                <div id="logo">
                    <img src="images/logo.png" alt="">
                </div>
            </div>

            <div class="col-md-6">
                <p id="details">
                    <strong>Order:</strong> #00124 <br>
                    <strong>Issued:</strong> 20/07/2019 <br>
                    Due 7 days from date of issue
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Invoice</h2>
            </div>
            <div class="col-md-6">
                <strong class="margin-bottom-5">Supplier</strong>
                <p>
                    Listeo Ltd. <br>
                    21 St Andrews Lane <br>
                    London, CF44 6ZL, UK <br>
                </p>
            </div>
            <div class="col-md-6">
                <strong class="margin-bottom-5">Customer</strong>
                <p>
                    John Doe <br>
                    36 Edgewater Street <br>
                    Melbourne, 2540, Australia <br>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="margin-top-20">
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>VAT</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>Extended Plan</td>
                        <td>1</td>
                        <td>$0.00</td>
                        <td>$9.00</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-4 col-md-offset-8">
                <table id="totals">
                    <tr>
                        <th>Total Due</th>
                        <th><span>$9.00</span></th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <ul id="footer">
                    <li><span>www.example.com</span></li>
                    <li>office@example.com</li>
                    <li>(123) 123-456</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
