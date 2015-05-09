$(document).ready(function() {
	thread.formatDates();
	thread.formatQuotes();
});

thread = {
	formatDates: function() {
		$('.dateTime').each(function() {
			utcUnix = $(this).data('utc');
			// 04/27/15(Mon)22:02:14
			formatted = moment.unix(utcUnix).local().format('MM/DD/YY(ddd)HH:ss:SS');
			$(this).text(formatted);
		});
	},

	formatQuotes: function() {
		var threadsWithQuotes = [], quoting, quotingBlock, quotingPostInfo, quotingBackLinks;
		$(".quotelink").each(function() {
			quoting = $(this).text().substr(2);
			quotingBlock = $("#p" + quoting);
			if (quotingBlock) {
				// Is quoting OP?
				if ($(quotingBlock).hasClass("op")) {
					$(this).html('<a href="#p' + quoting + '" class="quotelink">&gt;&gt;' + quoting + ' (OP)</a>');
				}

				quotingBackLinks = $(".postInfo.desktop#pi" + quoting + " #bl_" + quoting);

				if (quotingBackLinks) {
					$(quotingBackLinks).append('<span><a href="#' + quoting + '" class="quotelink">>>' + quoting + '</a></span>');
				}
			}
		});
	}
};