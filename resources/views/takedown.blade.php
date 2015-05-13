@extends('master')

@section('title', 'Takedown Request - 4archive')
@section('contentHeader', 'Takedown Request')

@section('content')
<div class="hp-content">
    <p>If you believe archived content on 4archive infringes on your rights, someone else's rights, or the law, you can fill out the field below.</p>
    <p>Please include in the additional information field why you believe it infringes on your rights or someone else's rights, or which law is being broken by the content.</p>
    <p>Be aware that by submitting a takedown request, you are aware of the possibility that your request may be made available to the public.</p>
    <hr />
    
    @if (session('success'))
    <div class="alert success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert error">{{ (session('error')) }}</div>
    @endif
    <form method="post" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label>URI *</label>
        <input type="text" name="uri" placeholder="/b/res/123" value="{{ isset($uri) ? $uri : "" }}" />
        <label>Reason *</label>
        <select name="reason">
            <option>This thread contains my personal information</option>
            <option>This thread contains posts that violate United States federal/state law</option>
            <option>This thread is against 4archive rules</option>
            <option>Formal DMCA Request</option>
            <option value="Other">Other (specify in additional information)</option>
        </select>
        <label>Additional information *</label>
        <textarea name="info"></textarea>
        <label>Captcha *</label>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_PUBLIC') }}"></div>
        <input type="submit" name="submit" value="Submit request" />
    </form>
</div>
@stop