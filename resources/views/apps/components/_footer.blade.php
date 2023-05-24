<div id="footer" class="margin-top-15">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6">
                <img class="footer-logo" src="{{ asset('assets/images/logo.png') }}" alt="images du systeme">
                <br><br>
                <p>
                    Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.
                </p>
            </div>
            <div class="col-md-4 col-sm-6 ">
                <h4>Helpful Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('fee.index') }}">Pricing</a></li>
                    <li><a href="{{ route('term.details') }}">Privacy Policy</a></li>
                </ul>
                <ul class="footer-links">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Our Partners</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-3  col-sm-12">
                <h4>Contact Us</h4>
                <div class="text-widget">
                    <span>12345 Little Lonsdale St, Melbourne</span> <br>
                    Phone: <span>(+27) 662 669364 </span><br>
                    E-Mail:<span> <a href="#">info@ngomadigitech.com</a></span><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">© {{ now()->format('Y') }} NgomaDigiTech. All Rights Reserved.</div>
            </div>
        </div>
    </div>
</div>

<div id="backtotop"><a href="#"></a></div>
