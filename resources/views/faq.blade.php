@extends('master')

@section('title', 'FAQ - 4archive')
@section('contentHeader', 'FAQ')

@section('content')
<div class="hp-content">
	<strong id="rules">Are they any rules on 4archive?</strong>
	<p>Yeah.
		<ul class="indent">
			<li>Don't archive things that are obviously against the law for me to host.</li>
			<li>Don't archive "dumping ex's pictures", "pics you're not suppose to share" threads. They're annoying. I didn't make 4archive for it to become a revenge porn site.</li>
		</ul>
	</p>
	<hr />
	<strong>What are the requirements to archive a thread?</strong>
	<p>A thread must have at least ten replies to be archived. This is to eliminate random, completely unimportant threads from being archived.</p>
	
	<strong>Why are some threads showing "Image not found?" on every post?</strong>
	<p>For some reason, on rare occurrences, images will not upload to Imgur at all, and therefore show "Image not found" errors all over the thread. Sorry if this happens. I'm really lazy and don't want to debug it.</p>

	<strong>Why can't I archive threads on some of the boards?</strong>
	<p>Yeah, I'm super sorry. I blacklisted a very small amount of boards that I believe could cause a huge problem in the long run. These mainly include boards that are home to large images.</p>

	<strong>I archived a thread, and it's not there anymore. What happened to it?</strong>
	<p>The thread could've been removed because I obtained a takedown request from someone. If that wasn't the case, then I removed it because I didn't like it. Sorry.</p>

	<strong>What's a takedown request?</strong>
	<p>At the top of the website, I have a link to learn about how to send me a takedown request. Takedown requests can be sent if someone feels like an archived thread/post infringed on their rights, someone else's rights, or the law. I comply with all legit cases and will takedown what is necessary.</p>

	<strong>Why won't the view counter on my thread go up?</strong>
	<p>Threads are cached when ever they are viewed and are purged every hour. Views on the top right corner of threads are therefore updated every hour.</p>
	<p>Views per IP are also cached then purge them everyday at midnight EST. Your view will count once for that thread, per day. If you view your thread 100 times in 1 day, it'll count once, though if you view your thread once everyday for 100 days, it'll count 100 times.</p>

	<strong>I'm part of a law enforcement agency, and, as part of an investigation, I need IP logs from your website</strong>
	<p>Be aware that this is an archive, not a forum. I do not have IP addresses of people who posted the <em>original</em> content on 4chan.org. I do, however, store IP addresses of users who archived content and what content they archived. If you need to know who originally posted the content on 4chan.org, contact the 4chan administrator at <a href="mailto:moot@4chan.org">moot@4chan.org</a>. Law enforcement can contact me at <a href="mailto:admin@4archive.org">admin@4archive.org</a>. I will respond to any law enforcement agency or officer that attempts to contact me.</p>
	<br />
	<p>Any additional questions can be sent to me over <a href="http://www.twitter.com/4archive">twitter</a></p>
</div>
@stop