<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:apega="http://apega.ca/members-permit-holders/events/rss" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>$SiteConfig.Title</title>
		<description>$SiteConfig.Tagline</description>
		<lastBuildDate>$Date</lastBuildDate>
		<% if RSSItems %>
		<% loop RSSItems %>
		<item>
			<title>$Title</title>
			<content><![CDATA[ $Details ]]></content>
			<date>$StartDateTime</date>
			<link>$Up.baselinkURL$InternalLink</link>
		</item>
		<% end_loop %>
		<% end_if %>
	</channel>
</rss>