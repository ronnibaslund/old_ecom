<?php
switch ($type) {
    case 'is_primary':
        $form = 'primary';
        break;
    case 'is_billing':
        $form = 'billing';
        break;
    case 'is_shipping':
        $form = 'shipping';
        break;
    default:
        $form = 'primary';
}
?>

<input type="hidden" name="type" value="{{ $type }}">
<input type="hidden" name="customer_id" value="{{ $customer_id }}">

<div class="form-group">
    <label for="{{ $form }}[firstname]">Fornavn</label>
    <input type="text" class="form-control" name="{{ $form }}[firstname]" id="{{ $form }}[firstname]" placeholder="Fornavn" value="{{ $address->firstname or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[lastname]">Efternavn</label>
    <input type="text" class="form-control" name="{{ $form }}[lastname]" id="{{ $form }}[lastname]" placeholder="Efternavn" value="{{ $address->lastname or '' }}">
</div>

@if($type == 'is_primary')
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" value="{{ $email or '' }}">
</div>
@endif

<div class="form-group">
    <label for="{{ $form }}[organization]">Firma</label>
    <input type="text" class="form-control" name="{{ $form }}[organization]" id="{{ $form }}[organization]" placeholder="Firma navn" value="{{ $address->organization or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[street]">Adresse</label>
    <input type="text" class="form-control" name="{{ $form }}[street]" id="{{ $form }}[street]" placeholder="Adresse" value="{{ $address->street or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[postcode]">Postnr.</label>
    <input type="text" class="form-control" name="{{ $form }}[postcode]" id="{{ $form }}[postcode]" placeholder="Post nummer" value="{{ $address->postcode or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[city]">By</label>
    <input type="text" class="form-control" name="{{ $form }}[city]" id="{{ $form }}[city]" placeholder="By" value="{{ $address->city or '' }}">
</div>

<div class="form-group">
    <label>Land</label>
    <select class="form-control" name="{{ $form }}[country_id]">
        <option>Vælg land</option>
        @if($countries)
        @foreach($countries as $country)
        <option value="{{ $country->id }}" @if(isset($address) and $address->country_id == $country->id) selected @endif>{{ $country->name }}</option>
        @endforeach
        @endif
    </select>
</div>

<div class="form-group">
    <label for="{{ $form }}[phone]">Telefon</label>
    <input type="text" class="form-control" name="{{ $form }}[phone]" id="{{ $form }}[phone]" placeholder="Telefon nummer" value="{{ $address->phone or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[ean]">EAN</label>
    <input type="text" class="form-control" name="{{ $form }}[ean]" id="{{ $form }}[ean]" placeholder="EAN" value="{{ $address->ean or '' }}">
</div>

<div class="form-group">
    <label for="{{ $form }}[cvr]">CVR</label>
    <input type="text" class="form-control" name="{{ $form }}[cvr]" id="{{ $form }}[cvr]" placeholder="CVR" value="{{ $address->cvr or '' }}">
</div>