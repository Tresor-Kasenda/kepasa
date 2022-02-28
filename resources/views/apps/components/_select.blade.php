<select name="cityName" id="cityName" class="chosen-select">
    <option>All City</option>
    @foreach($data['cities'] as $city)
        <option value="{{ $city->cityName }}">
            {{ $city->cityName ?? "" }}
        </option>
    @endforeach
</select>
