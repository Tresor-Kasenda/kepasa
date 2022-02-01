@extends('layouts.front')

@section('title', "Nous contactez")

@section('content')
    <div class="contact-map margin-bottom-30">
        <div id="singleListingMap-container">
            <div
                id="singleListingMap"
                data-latitude="40.70437865245596"
                data-longitude="-73.98674011230469"
                data-map-icon="im im-icon-Map2"
            ></div>
            <a href="#" id="streetView">Street View</a>
        </div>
        <div class="address-box-container">
            <div class="address-container" data-background-image="images/our-office.jpg">
                <div class="office-address">
                    <h3>Our Office</h3>
                    <ul>
                        <li>John Street 304</li>
                        <li>New York</li>
                        <li>Phone (123) 123-456 </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="headline margin-bottom-30">Find Us There</h4>
                <div class="sidebar-textbox">
                    <p>
                        Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.
                    </p>
                    <ul class="contact-details">
                        <li>
                            <i class="im im-icon-Phone-2"></i>
                            <strong>Phone:</strong>
                            <span>(123) 123-456 </span>
                        </li>
                        <li>
                            <i class="im im-icon-Fax"></i>
                            <strong>Fax:</strong>
                            <span>(123) 123-456 </span>
                        </li>
                        <li>
                            <i class="im im-icon-Globe"></i>
                            <strong>Web:</strong>
                            <span>
                                <a href="#">www.example.com</a>
                            </span>
                        </li>
                        <li>
                            <i class="im im-icon-Envelope"></i>
                            <strong>E-Mail:</strong>
                            <span>
                                <a href="#">office@example.com</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="notification success closeable" id="flash">
                    <p>
                        <span>Success!</span>
                        <span id="success"></span>
                    </p>
                    <a class="close"></a>
                </div>
                <section>
                    <h4 class="headline margin-bottom-35">Contact Form</h4>
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <input
                                        name="name"
                                        type="text"
                                        id="name"
                                        placeholder="Your Name"
                                        required
                                    />
                                    <div id="name-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <input
                                        name="email"
                                        type="email"
                                        id="email"
                                        placeholder="Email Address"
                                        required
                                    />
                                    <div id="email-error"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input
                                name="subject"
                                type="text"
                                id="subject"
                                placeholder="Subject"
                                required
                            />
                            <div id="subject-error"></div>
                        </div>
                        <div>
                            <textarea
                                name="comments"
                                rows="3"
                                id="comments"
                                placeholder="Message"
                                required
                            ></textarea>
                            <div id="comment-error"></div>
                        </div>
                        <button type="submit" class="submit button" id="submit">
                            Submit Message
                        </button>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#name-error').hide()
            $('#email-error').hide()
            $('#subject-error').hide()
            $('#comment-error').hide()

            let error_name = false;
            let error_email = false;
            let error_subject = false;
            let error_comment = false;

            $('#flash').hide()

            $('#name').focusout(function () {
                check_name();
            });

            $('#email').focusout(function () {
                check_email();
            });

            $('#subject').focusout(function () {
                check_subject();
            });

            $('#comments').focusout(function () {
                check_comments();
            });

            function check_name(){
                let name_length = $("#name").val().length;
                if(name_length < 5){
                    $("#name-error").html("Name should be at leat 5 characters");
                    $("#name-error").show().addClass("text-danger");
                    error_name = true;
                }else{
                    $("#name_error").hide();
                }
            }

            function check_comments(){
                let comment_length = $("#comments").val().length;
                if(comment_length < 10){
                    $("#comment-error").html("Name should be at leat 5 characters");
                    $("#comment-error").show().addClass("text-danger");
                    error_name = true;
                }else{
                    $("#comment-error").hide();
                }
            }

            function check_email(){
                let email_length = $("#email").val();
                const pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                if(email_length < 5 && pattern.test(email_length)){
                    $("#email-error").html("Email should be at leat 5 characters");
                    $("#email-error").show().addClass("text-danger");
                    error_email = true;
                }else{
                    $("#email-error").hide();
                }
            }

            function check_subject(){
                let subject_length = $("#subject").val().length;
                if(subject_length < 5){
                    $("#subject-error").html("Name should be at leat 5 characters");
                    $("#subject-error").show().addClass("text-danger");
                    error_name = true;
                }else{
                    $("#subject-error").hide();
                }
            }


            $('#submit').click(function(e) {
                e.preventDefault()
                const name = $('#name').val()
                const email = $('#email').val()
                const subject = $('#subject').val()
                const messages = $('#comments').val()

                const pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

                if (name.length <= 5 || pattern.test(email) || subject.length <= 5 || messages.length <= 10){
                    check_name()
                    check_email()
                    check_subject()
                    check_comments()
                }else {

                    $.ajax({
                        url:`{{ route('contact.store') }}`,
                        method:'POST',
                        data:{
                            name:name,
                            email:email,
                            subject: subject,
                            messages: messages
                        },
                        success:function(response){
                            if (response){
                                $('#name').val(" ")
                                $('#email').val(" ")
                                $('#subject').val(" ")
                                $('#comments').val(" ")
                                $('#flash').show()
                                $("#success").html(response.message)
                                setTimeout(function(){
                                    $("#flash").hide();
                                }, 4000);
                            }
                        },
                    });
                }
            });
        })
    </script>
@endsection
