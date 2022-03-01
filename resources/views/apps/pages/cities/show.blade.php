@extends('layouts.front')

@section('title', "Detail sur une ville promus")

@section('content')
    <div class="clearfix"></div>
    <div class="listing-slider mfp-gallery-container margin-bottom-0">
        <a
            href=""
            data-background-image=""
            class="item mfp-gallery"
            title="Title 1"
        ></a>
    </div>

    <div class="container">
        <div class="row sticky-wrapper">
            <div class="col-lg-8 col-md-8 padding-right-30">
                <div id="titlebar" class="listing-titlebar">
                    <div class="listing-titlebar-title">
                        <h2>{{ strtoupper($data['0']->cityName) ?? "" }}</h2>
                    </div>
                </div>

                <div id="listing-nav" class="listing-nav-container">
                    <ul class="listing-nav">
                        <li><a href="#listing-overview" class="active">Historique</a></li>
                        <li><a href="#listing-pricing-list">Pricing</a></li>
                        <li><a href="#listing-location">Location</a></li>
                        <li><a href="#listing-reviews">Reviews</a></li>
                        <li><a href="#add-review">Add Review</a></li>
                    </ul>
                </div>
                <div id="listing-overview" class="listing-section">
                    <p>
                        Ut euismod ultricies sollicitudin. Curabitur sed dapibus nulla. Nulla eget iaculis lectus. Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend. Morbi varius, nulla sit amet rutrum elementum, est elit finibus tellus, ut tristique elit risus at metus.
                    </p>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.
                    </p>

                    <div class="listing-links-container">

                        <ul class="listing-links contact-links">
                            <li><a href="tel:12-345-678" class="listing-links"><i class="fa fa-phone"></i> +12 345 6578</a></li>
                            <li><a href="mailto:mail@example.com" class="listing-links"><i class="fa fa-envelope-o"></i> mail@example.com</a>
                            </li>
                            <li><a href="#" target="_blank"  class="listing-links"><i class="fa fa-link"></i> www.example.com</a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <ul class="listing-links">
                            <li><a href="#" target="_blank" class="listing-links-fb"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                            <li><a href="#" target="_blank" class="listing-links-yt"><i class="fa fa-youtube-play"></i> YouTube</a></li>
                            <li><a href="#" target="_blank" class="listing-links-ig"><i class="fa fa-instagram"></i> Instagram</a></li>
                            <li><a href="#" target="_blank" class="listing-links-tt"><i class="fa fa-twitter"></i> Twitter</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <h3 class="listing-desc-headline">Amenities</h3>
                    <ul class="listing-features checkboxes margin-top-0">
                        <li>Elevator in building</li>
                        <li>Friendly workspace</li>
                        <li>Instant Book</li>
                        <li>Wireless Internet</li>
                        <li>Free parking on premises</li>
                        <li>Free parking on street</li>
                    </ul>
                </div>
                <div id="listing-pricing-list" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Pricing</h3>
                    <div class="show-more">
                        <div class="pricing-list-container">
                            <h4>Burgers</h4>
                            <ul>
                                <li>
                                    <h5>Classic Burger</h5>
                                    <p>Beef, salad, mayonnaise, spicey relish, cheese</p>
                                    <span>$6</span>
                                </li>
                                <li>
                                    <h5>Cheddar Burger</h5>
                                    <p>Cheddar cheese, lettuce, tomato, onion, dill pickles</p>
                                    <span>$6</span>
                                </li>
                                <li>
                                    <h5>Veggie Burger</h5>
                                    <p>Panko crumbed and fried, grilled peppers and mushroom</p>
                                    <span>$6</span>
                                </li>
                                <li>
                                    <h5>Chicken Burger</h5>
                                    <p>Cheese, chicken fillet, avocado, bacon, tomatoes, basil</p>
                                    <span>$6</span>
                                </li>
                            </ul>
                            <h4>Drinks</h4>
                            <ul>
                                <li>
                                    <h5>Frozen Shake</h5>
                                    <span>$4</span>
                                </li>
                                <li>
                                    <h5>Orange Juice</h5>
                                    <span>$4</span>
                                </li>
                                <li>
                                    <h5>Beer</h5>
                                    <span>$4</span>
                                </li>
                                <li>
                                    <h5>Water</h5>
                                    <span>Free</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a>
                </div>
                <div id="listing-location" class="listing-section">
                    <h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Location</h3>

                    <div id="singleListingMap-container">
                        <div id="singleListingMap" data-latitude="40.70437865245596" data-longitude="-73.98674011230469" data-map-icon="im im-icon-Hamburger"></div>
                        <a href="#" id="streetView">Street View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 margin-top-75 sticky">

                <div class="verified-badge with-tip" data-tip-content="Listing has been verified and belongs the business owner or manager.">
                    <i class="sl sl-icon-check"></i> Verified Listing
                </div>

                <div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
                    <h3>
                        <i class="fa fa-calendar-check-o "></i> Booking
                    </h3>
                    <div class="row with-forms  margin-top-0">
                        <div class="col-lg-12">
                            <input type="text" id="date-picker" placeholder="Date" readonly="readonly">
                        </div>
                        <div class="col-lg-12">
                            <div class="panel-dropdown time-slots-dropdown">
                                <a href="#">Time Slots</a>
                                <div class="panel-dropdown-content padding-reset">
                                    <div class="panel-dropdown-scrollable">
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-1">
                                            <label for="time-slot-1">
                                                <strong>8:30 am - 9:00 am</strong>
                                                <span>1 slot available</span>
                                            </label>
                                        </div>
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-2">
                                            <label for="time-slot-2">
                                                <strong>9:00 am - 9:30 am</strong>
                                                <span>2 slots available</span>
                                            </label>
                                        </div>
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-3">
                                            <label for="time-slot-3">
                                                <strong>9:30 am - 10:00 am</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-4">
                                            <label for="time-slot-4">
                                                <strong>10:00 am - 10:30 am</strong>
                                                <span>3 slots available</span>
                                            </label>
                                        </div>
                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-5">
                                            <label for="time-slot-5">
                                                <strong>13:00 pm - 13:30 pm</strong>
                                                <span>2 slots available</span>
                                            </label>
                                        </div>

                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-6">
                                            <label for="time-slot-6">
                                                <strong>13:30 pm - 14:00 pm</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>

                                        <div class="time-slot">
                                            <input type="radio" name="time-slot" id="time-slot-7">
                                            <label for="time-slot-7">
                                                <strong>14:00 pm - 14:30 pm</strong>
                                                <span>1 slots available</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel-dropdown">
                                <a href="#">Guests <span class="qtyTotal" name="qtyTotal">1</span></a>
                                <div class="panel-dropdown-content">
                                    <div class="qtyButtons">
                                        <div class="qtyTitle">Adults</div>
                                        <input type="text" name="qtyInput" value="1">
                                    </div>
                                    <div class="qtyButtons">
                                        <div class="qtyTitle">Childrens</div>
                                        <input type="text" name="qtyInput" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="button book-now fullwidth margin-top-5">Request To Book</a>
                </div>
                <div class="boxed-widget opening-hours margin-top-35">
                    <div class="listing-badge now-open">Now Open</div>
                    <h3>
                        <i class="sl sl-icon-clock"></i> Opening Hours
                    </h3>
                    <ul>
                        <li>Monday <span>9 AM - 5 PM</span></li>
                        <li>Tuesday <span>9 AM - 5 PM</span></li>
                        <li>Wednesday <span>9 AM - 5 PM</span></li>
                        <li>Thursday <span>9 AM - 5 PM</span></li>
                        <li>Friday <span>9 AM - 5 PM</span></li>
                        <li>Saturday <span>9 AM - 3 PM</span></li>
                        <li>Sunday <span>Closed</span></li>
                    </ul>
                </div>
                <div class="boxed-widget margin-top-35">
                    <div class="hosted-by-title">
                        <h4>
                            <span>Hosted by</span>
                            <a href="">Tom Perrin</a>
                        </h4>
                        <a href="" class="hosted-by-avatar">
                            <img src="" alt="">
                        </a>
                    </div>
                    <ul class="listing-details-sidebar">
                        <li>
                            <i class="sl sl-icon-phone"></i> (123) 123-456
                        </li>
                        <li>
                            <i class="fa fa-envelope-o"></i>
                            <a href="#">tom@example.com</a>
                        </li>
                    </ul>
                    <ul class="listing-details-sidebar social-profiles">
                        <li>
                            <a href="#" class="facebook-profile">
                                <i class="fa fa-facebook-square"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="#" class="twitter-profile">
                                <i class="fa fa-twitter"></i> Twitter
                            </a>
                        </li>
                    </ul>
                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                        <div class="small-dialog-header">
                            <h3>Send Message</h3>
                        </div>
                        <div class="message-reply margin-top-0">
                            <textarea cols="40" rows="3" placeholder="Your message to Tom"></textarea>
                            <button class="button">Send Message</button>
                        </div>
                    </div>
                    <a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim">
                        <i class="sl sl-icon-envelope-open"></i> Send Message
                    </a>
                </div>
                <div class="listing-share margin-top-40 margin-bottom-40 no-border">
                    <button class="like-button">
                        <span class="like-icon"></span> Bookmark this listing
                    </button>
                    <span>159 people bookmarked this place</span>
                    <ul class="share-buttons margin-top-40 margin-bottom-0">
                        <li>
                            <a class="fb-share" href="#">
                                <i class="fa fa-facebook"></i> Share
                            </a>
                        </li>
                        <li>
                            <a class="twitter-share" href="#">
                                <i class="fa fa-twitter"></i> Tweet
                            </a>
                        </li>
                        <li>
                            <a class="gplus-share" href="#">
                                <i class="fa fa-google-plus"></i> Share
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>>
@endsection
