@extends('master')

@section('content')
<div class="hp-content">
	@if (config('archive.disabled'))
	<span class="slogan">Archiving threads is currently disabled.</span>
	<p class="center">Follow <a href="http://twitter.com/4archive">@4archive</a> for more information.</p>
	@else
	<span class="slogan">Easily archive your favorite 4chan threads</span>
	<form id="archiveForm">
		<input type="text" id="threadUrl" placeholder="Enter a valid 4chan thread URL" />
		<input type="button" id="doArchive" onClick="processForm()" value="Archive!" />
	</form>
	<p class="center">By archiving a thread, you agree to the very small amount of <a href="/faq#rules">rules</a> and the <a href="/terms">terms of service</a></p>
	<p class="center">Why haven't you guys learned that .webm threads won't work properly on 4archive? .webm can't be uploaded to Imgur or Imageshack.</p>
	@endif
	<hr />
	<div id="home-list">
		<div class="columns">
			<div class="column left" id="latest-threads-list">
				<span class="area-title">Latest Threads</span>
				<div id="latest-threads">Loading...</div>
				<div class="pagination"></div>
			</div>
			<div class="column right" id="popular-threads-list">
				<span class="area-title">Popular Threads</span>
				<div id="popular-threads">Loading...</div>
				<div class="pagination"></div>
			</div>
		</div>
	</div>
	<hr />
	<div class="columns">
		<div class="column left">
			<a class="twitter-timeline" href="https://twitter.com/4archive" width="370" height="300" data-widget-id="433690666611134464">Tweets by @4archive</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<div class="column right">
			<span class="area-title">Statistics</span>
			<div id="the-statistics">Loading....</div>
		</div>
	</div>
</div>
@stop