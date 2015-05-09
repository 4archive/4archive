<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="noarchive" name="robots">
    <meta content="{{{ $op->body }}}" name="description">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <link href="/favicon.ico" rel="shortcut icon">

    @if (in_array($thread->board, config('archive.nsfw')))
    <link href="/css/4chan/yotsubanew.607.css" rel="stylesheet">
    <link href="/css/4chan/yotsubamobile.607.css" rel="stylesheet">
    @else
    <link href="/css/4chan/yotsubluenew.607.css" rel="stylesheet">
    <link href="/css/4chan/yotsubluemobile.607.css" rel="stylesheet">
    @endif

    <title>{!! substr($op->body, 0, 15) !!} - Archived from /{{ $thread->board }}/ - 4archive.org</title>

    <!-- 4archive style -->
    <style type="text/css">
        .backlink {
            display:inline-block;
            padding-left:0px !important;
        }

        .title {
            margin:15px 0;
            border:0;
        }

        .boardBanner>img {
            border:0 !important;
            margin:0 !important;
            width:auto !important;
            height:auto !important;
        }

        .announcement-title {
            font-weight:bold;
            font-size:24px;
        }
        .announcement-body {
            margin:8px 0;
        }
        .announcement-body p { 
            margin:0;
            padding:0;
        }
    </style>
</head>

<body class="board_{{ $thread->board }}">

    <div class="boardBanner">
        <img class="title" src="/image/long-logo.png" />
        <hr />
        <div id="4archive-announcements">
            <span class="announcement-title">4archive is now open-source on Github</span>
            <div class="announcement-body">
                <p>Our users can now contribute to our code-base by making their own features, opening bug issues, and consulting on changes.</p>
                <p>4archive's code-base uses Laravel's micro-framework Lumen in PHP.</p>
                <p>You can see our source <a href="https://github.com/4archive/4archive">here</a>.</p>
            </div>
        </div>
    </div>
    <hr class="desktop" id="op">
    <div class="board">
        <div class="thread" id="t{{ $op->chan_id }}">
            <!-- OP Container -->
            <div class="postContainer opContainer" id="pc{{ $op->chan_id }}">
                <div class="post op" id="p{{ $op->chan_id }}">
                    <div class="postInfoM mobile" id="pim{{ $op->chan_id }}">
                        <span class="nameBlock"><span class=
                        "name">{{ $op->name }}</span><br>
                        <span class="subject">{{ $op->subject }}</span></span> <span class=
                        "dateTime postNum" data-utc=
                        "{{ strtotime($op->post_timestamp) }}">04/27/15(Mon)22:01:46 <a href=
                        "#p{{ $op->chan_id }}" title=
                        "Link to this post">No.</a><a href=
                        "javascript:quote('{{ $op->chan_id }}');" title=
                        "Reply to this post">{{ $op->chan_id }}</a></span>
                    </div>

                    <div class="file" id="f{{ $op->chan_id }}">
                        <div class="fileText" id="fT{{ $op->chan_id }}">
                            File: <a href=
                            "{{ $op->image_url }}" target=
                            "_blank">{{ $op->original_image_name }}</a> (102 KB, {{ $op->image_width }}x{{ $op->image_height }})
                        </div><a class="fileThumb" href=
                        "{{ $op->image_url }}" target=
                        "_blank"><img alt="{{ $op->getImageSize() }}" src=
                        "{{ $op->image_url }}" style=
                        "height: {{ $op->thumb_height }}px; width: {{ $op->thumb_width }}px;">

                        <div class="mFileInfo mobile" data-tip=""
                        data-tip-cb="mShowFull">
                            {{ $op->getImageSize() }}
                        </div></a>
                    </div>

                    <div class="postInfo desktop" id="pi{{ $op->chan_id }}">
                        <input name="{{ $op->chan_id }}" type="checkbox" value=
                        "delete"> <span class="subject"></span>
                        <span class="nameBlock"><span class=
                        "name">{{ $op->name }}</span></span> <span class=
                        "dateTime" data-utc=
                        "{{ strtotime($op->post_timestamp) }}">00/00/00(Sun)00:00:00</span>
                        <span class="postNum desktop"><a href="#p{{ $op->chan_id }}"
                        title="Link to this post">No.</a><a href=
                        "javascript:quote('{{ $op->chan_id }}');" title=
                        "Reply to this post">{{ $op->chan_id }}</a></span>
                        
                        <a href="#" class="postMenuBtn">▶</a>
                        <div id="bl_{{ $op->chan_id }}" class="backlink"></div>
                    </div>

                    <blockquote class="postMessage" id="m{{ $op->chan_id }}">
                        {!! $op->body !!}
                    </blockquote>
                </div>
            </div>
            <!-- /OP Container -->

            <!-- Replies -->
            @foreach ($replies as $reply)
            <div class="postContainer replyContainer" id="pc{{ $reply->chan_id }}">
                <div class="sideArrows" id="sa{{ $reply->chan_id }}">
                    &gt;&gt;
                </div>

                <div class="post reply" id="p{{ $reply->chan_id }}">
                    <div class="postInfoM mobile" id="pim{{ $reply->chan_id }}">
                        <span class="nameBlock"><span class=
                        "name">{{ $reply->name }}</span><br></span><span class=
                        "dateTime postNum" data-utc=
                        "{{ strtotime($reply->post_timestamp) }}">04/27/15(Mon)22:02:14 <a href=
                        "#p{{ $reply->chan_id }}" title=
                        "Link to this post">No.</a><a href=
                        "javascript:quote('{{ $reply->chan_id }}');" title=
                        "Reply to this post">{{ $reply->chan_id }}</a></span>
                    </div>

                    <div class="postInfo desktop" id="pi{{ $reply->chan_id }}">
                        <input name="{{ $reply->chan_id }}" type="checkbox" value=
                        "delete">
                        <span class="nameBlock">
                            <span class="name">{{ $reply->name }}</span>
                            @if ($reply->tripcode)
                            <span class="postertrip">{{ $reply->tripcode }}</span>
                            @endif
                        </span>
                        <span class="dateTime" data-utc="{{ strtotime($reply->post_timestamp) }}">00/00/00(Sun)00:00:00</span>
                        <span class="postNum desktop"><a href="#p{{ $reply->chan_id }}"
                        title="Link to this post">No.</a><a href=
                        "javascript:quote('{{ $reply->chan_id }}');" title=
                        "Reply to this post">{{ $reply->chan_id }}</a></span>

                        <a href="#" class="postMenuBtn">▶</a>
                        <div id="bl_{{ $op->chan_id }}" class="backlink"></div>
                    </div>
                    
                    @if ($reply->image_size > 0)
                    <div class="file" id="f{{ $reply->chan_id }}">
                        <div class="fileText" id="fT{{ $reply->chan_id }}">
                            File: <a href=
                            "{{ $reply->image_url }}" target=
                            "_blank">{{ $reply->original_image_name }}</a> (42 KB, {{ $reply->image_width }}x{{ $reply->image_height }})
                        </div><a class="fileThumb" href=
                        "{{ $reply->image_url }}" target=
                        "_blank"><img alt="4{{ $op->getImageSize() }}" src=
                        "{{ $reply->image_url }}" style=
                        "height: {{ $reply->thumb_height }} px; width: {{ $reply->thumb_width }}px;">

                        <div class="mFileInfo mobile" data-tip=""
                        data-tip-cb="mShowFull">
                            {{ $op->getImageSize() }}
                        </div></a>
                    </div>
                    @endif

                    <blockquote class="postMessage" id="m{{ $reply->chan_id }}">
                        {!! $reply->body !!}
                    </blockquote>
                </div>
            </div>
        </div>
        @endforeach
        <hr class="desktop">
    </div>

    <div class="absBotText" id="absbot">
        <div class="mobile">
            <span id="disable-mobile">[<a href=
            "javascript:disableMobile();">Disable Mobile View / Use Desktop
            Site</a>]<br>
            <br></span><span id="enable-mobile">[<a href=
            "javascript:enableMobile();">Enable Mobile View / Use Mobile
            Site</a>]<br>
            <br></span>
            <span>Page generated {{ date('M d, Y \a\t h:i A') }}</span>
        </div><span class="absBotDisclaimer">All trademarks and copyrights on
        this page are owned by their respective parties. Images uploaded are
        the responsibility of the original Poster. Comments are owned by the
        original Poster.</span> <br />
        <span class="absBotDisclaimer">All content shown on this page originated from 4chan.org.
        4archive does not take responsibility for the content shown.</span><br />

        <span class="absBotDisclaimer">Page generated {{ date('M d, Y \a\t h:i A') }}</span>
        
    </div>
</body>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/js/thread.js"></script>
</html>