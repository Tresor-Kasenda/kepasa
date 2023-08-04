<select name="cityName" id="cityName" class="chosen-select">
    <option>All City</option>
    @foreach($data['cities'] as $city)
        <option value="{{ $city->city_name ?? "" }}">
            {{ $city->city_name ?? "" }}
        </option>
    @endforeach
</select>
