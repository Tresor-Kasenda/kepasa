@foreach($events as $event)
    <div class="col-lg-6 col-md-12">
        <a href="#" class="listing-item-container">
            <div class="listing-item">
                <img src="" alt="">

                <div class="listing-badge now-open">Now Open</div>

                <div class="listing-item-content">
                    <span class="tag">Eat & Drink</span>
                    <h3>Tom's Restaurant <i class="verified-icon"></i></h3>
                    <span>964 School Street, New York</span>
                </div>
                <span class="like-icon"></span>
            </div>
            <div class="star-rating" data-rating="3.5">
                <div class="rating-counter">(12 reviews)</div>
            </div>
        </a>
    </div>
@endforeach
