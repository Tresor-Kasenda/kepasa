@extends('layouts.front')

@section('title', "Formulaire de démande de promotion de votre ville")

@section('content')
    <div class="contact-map margin-bottom-60"></div>

    <div class="clearfix"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="headline margin-bottom-30">Promote Your City</h4>
                <div class="sidebar-textbox">
                    <p> Please contact us if you want your city to be featured on our home page and to have a special page and, therefore, appear anywhere in Africa and the world where our site is visited. The price for promoting your city depends on the promotion period. We offer promotions of 1, 3, 6 and 12 months. </p>

                    <p> For cities that are not featured on our home page, only events organised there are displayed and promoted. </p>

                    <ul class="contact-details">
                        <li>
                            <i class="im im-icon-Phone-2"></i>
                            <strong>Contact Nbr:</strong>
                            <span>(+27) 662 669364 </span>
                        </li>
                        <li>
                            <i class="im im-icon-Globe"></i>
                            <strong>Web:</strong>
                            <span>
                                <a href="https://www.ngomadigitech.com" target="__blank">www.ngomadigitech.com</a>
                            </span>
                        </li>
                        <li>
                            <i class="im im-icon-Envelope"></i>
                            <strong>E-Mail:</strong>
                            <span>
                                <a href="mailto:info@ngomadigitech.com">info@ngomadigitech.com</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div id="contact-message"></div>
                <form action="{{ route('promoted.store') }}" method="POST">
                    @csrf
                    <h4 class="headline margin-bottom-35">Contact Us</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <select name="title" id="civilité">
                                <option value="Monsieur">Mr.</option>
                                <option value="saab">Mme</option>
                                <option value="opel">Ms</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input
                                name="username"
                                type="text"
                                id="username"
                                placeholder="User Name"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="firstname"
                                type="text"
                                id="firstname"
                                placeholder="First Name"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="lastname"
                                type="text"
                                id="lastname"
                                placeholder="Last Name"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="phones"
                                type="text"
                                id="phones"
                                placeholder="Mobile Number"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="alternate_number"
                                type="text"
                                id="alternate_number"
                                placeholder="Alternative Number"
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="email"
                                type="email"
                                id="email"
                                placeholder="Email Address"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="position"
                                type="text"
                                id="position"
                                placeholder="Position/Title"
                                requir
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="department"
                                type="text"
                                placeholder="Goverment Dpt./Inst."
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="city"
                                type="text"
                                id="city"
                                placeholder="City"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <input
                                name="state"
                                type="text"
                                id="state"
                                placeholder="Province/State"
                                required
                            />
                        </div>
                        <div class="col-md-6">
                            <select name="country">
                                @include('apps.components._country')
                            </select>
                        </div>
                        <div class="col-md-12">
                            <textarea
                                name="message"
                                rows="2"
                                id="comments"
                                placeholder="Message"
                                spellcheck="true"
                                required
                            ></textarea>
                        </div>
                    </div>
                    <button class="pull-right submit button" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
