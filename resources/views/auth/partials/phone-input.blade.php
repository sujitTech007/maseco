@php
    $phoneInputId = $phoneInputId ?? 'phone';
    $phoneInputClass = $phoneInputClass ?? 'form-control';
    $selectedCountryCode = old('country_code', $countryCode ?? '+1');
@endphp
<div class="{{ $phoneWrapperClass ?? 'd-flex mobileNumber phone-country-field' }}">
    <select
        id="{{ $phoneInputId }}_country_code"
        name="country_code"
        class="selectpicker {{ $countrySelectClass ?? '' }}"
        data-live-search="true"
        data-country-code-select
        data-selected-country-code="{{ $selectedCountryCode }}"
        aria-label="Country calling code"
        required>
        @include('auth.partials.country-code-options')
    </select>
    <input
        type="tel"
        name="phone"
        id="{{ $phoneInputId }}"
        class="{{ $phoneInputClass }}"
        value="{{ old('phone', $phoneValue ?? '') }}"
        placeholder="{{ $phonePlaceholder ?? 'Enter phone number' }}"
        autocomplete="tel-national"
        inputmode="tel"
        {{ ($phoneRequired ?? true) ? 'required' : '' }}>
</div>
