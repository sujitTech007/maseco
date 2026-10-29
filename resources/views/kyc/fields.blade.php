@php
  $data = $kyc?->form_data ?? [];
  $value = fn ($field, $fallback = '') => old($field, $data[$field] ?? $fallback);
@endphp

<h5 class="mb-3">Personal details</h5>
<div class="row g-3 mb-4">
  <div class="col-md-6"><label class="form-label" for="kyc_name">Full name *</label><input id="kyc_name" class="form-control" name="name" value="{{ $value('name', $user->name) }}" maxlength="255" required></div>
  <div class="col-md-6"><label class="form-label" for="kyc_email">Email address *</label><input id="kyc_email" class="form-control" type="email" name="email" value="{{ $value('email', $user->email) }}" maxlength="255" required></div>
  <div class="col-md-6"><label class="form-label" for="kyc_phone">Mobile number *</label><input id="kyc_phone" class="form-control" type="tel" name="phone" value="{{ $value('phone', trim(($user->country_code ?? '') . ' ' . ($user->phone ?? ''))) }}" maxlength="30" required></div>
  <div class="col-md-6"><label class="form-label" for="kyc_country">Country *</label><select id="kyc_country" class="form-select" name="country" required><option value="">Select country</option>@foreach($countries as $country)<option value="{{ $country }}" @selected($value('country', $user->country ?? '') === $country)>{{ $country }}</option>@endforeach</select></div>
  <div class="col-md-6"><label class="form-label" for="kyc_city">City *</label><input id="kyc_city" class="form-control" name="city" value="{{ $value('city') }}" maxlength="100" required></div>
  <div class="col-12"><label class="form-label" for="kyc_address">Address *</label><textarea id="kyc_address" class="form-control" name="address" rows="3" maxlength="2000" required>{{ $value('address', $user->address ?? '') }}</textarea></div>
  <div class="col-md-6"><label class="form-label" for="profile_photo">Profile photo *</label><input id="profile_photo" class="form-control" type="file" name="profile_photo" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required><div class="form-text">JPG or PNG, up to 10 MB.</div></div>
</div>

<h5 class="mb-3">Identity verification</h5>
<div class="row g-3 mb-4">
  <div class="col-md-6"><label class="form-label" for="document_type">Document type *</label><select id="document_type" class="form-select" name="document_type" data-account-category="{{ $accountCategory }}" data-document-options='@json($documentTypeOptions)' required><option value="">Select document type</option>@foreach($documentTypes as $documentType)<option value="{{ $documentType }}" @selected($value('document_type', $kyc->document_type ?? '') === $documentType)>{{ $documentType }}</option>@endforeach</select></div>
  <div class="col-md-6"><label class="form-label" for="document_number">Document number *</label><input id="document_number" class="form-control" name="document_number" value="{{ $value('document_number', $kyc->document_number ?? '') }}" maxlength="100" required></div>
  <div class="col-md-6"><label class="form-label" for="document_back">Document back side (optional)</label><input id="document_back" class="form-control" type="file" name="document_back" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"></div>
  <div class="col-md-6"><label class="form-label" for="selfie_document">Selfie / profile verification (optional)</label><input id="selfie_document" class="form-control" type="file" name="selfie_document" accept=".jpg,.jpeg,.png,image/jpeg,image/png"></div>
</div>

<script>
  (() => {
    const country = document.getElementById('kyc_country');
    const documentType = document.getElementById('document_type');
    if (!country || !documentType) return;
    const optionsByCountry = JSON.parse(documentType.dataset.documentOptions || '{}');
    const category = documentType.dataset.accountCategory;
    country.addEventListener('change', () => {
      const previous = documentType.value;
      const options = (optionsByCountry[country.value] || optionsByCountry.default || {})[category] || [];
      documentType.replaceChildren(new Option('Select document type', ''));
      options.forEach((label) => documentType.add(new Option(label, label)));
      if (options.includes(previous)) documentType.value = previous;
    });
  })();
</script>

@if($type !== 'user')
  <h5 class="mb-3">Business details</h5>
  <div class="row g-3 mb-4">
    <div class="col-md-6"><label class="form-label" for="company_name">Company name *</label><input id="company_name" class="form-control" name="company_name" value="{{ $value('company_name', $user->company_name ?? '') }}" maxlength="255" required></div>
    <div class="col-md-6"><label class="form-label" for="business_type">Business type *</label><select id="business_type" class="form-select" name="business_type" required><option value="">Select business type</option>@foreach(['Manufacturer','Distributor','Supplier','Trader','Other'] as $businessType)<option value="{{ $businessType }}" @selected($value('business_type', $user->business_type ?? '') === $businessType)>{{ $businessType }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label" for="company_registration_number">Company registration number *</label><input id="company_registration_number" class="form-control" name="company_registration_number" value="{{ $value('company_registration_number') }}" maxlength="100" required></div>
    <div class="col-md-6"><label class="form-label" for="business_tax_id">Business tax ID *</label><input id="business_tax_id" class="form-control" name="business_tax_id" value="{{ $value('business_tax_id', $user->gst ?? '') }}" maxlength="100" required></div>
    <div class="col-md-6"><label class="form-label" for="gst_number">GST number</label><input id="gst_number" class="form-control" name="gst_number" value="{{ $value('gst_number', $user->gst ?? '') }}" maxlength="100"></div>
    <div class="col-12"><label class="form-label" for="business_address">Business address *</label><textarea id="business_address" class="form-control" name="business_address" rows="3" maxlength="2000" required>{{ $value('business_address', $user->address ?? '') }}</textarea></div>
  </div>
@endif
