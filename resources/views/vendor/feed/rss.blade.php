<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
        <title>{{ $meta['title'] }}></title>
        <link><![CDATA[{{ url($meta['link']) }}]]></link>
        <description><![CDATA[{{ $meta['description'] }}]]></description>
        <language>{{ $meta['language'] }}</language>
        <pubDate>{{ $meta['updated'] }}</pubDate>

        <atom:link href="{{url($meta['link'])}}" rel="self" type="application/rss+xml" />

        @foreach($items as $item)
            <item>
                <id>{{ $item->id }}</id>
                <title>{{ $item->title }}</title>
                <link>{{ url($item->link) }}</link>
                <description><![CDATA[{!! $item->summary !!}]]></description>
                <guid isPermaLink="true">{{ url($item->id) }}</guid>
                @if(is_array($item->category))
                <category><![CDATA[{{ $item->category[0] }}]]></category>
                @else
                <category><![CDATA[{{ $item->category }}]]></category>
                @endif
                <price><![CDATA[{{ $item->price }}]]></price>
                <pubDate>{{ $item->updated->toRssString() }}</pubDate>
                <media:content url="{{$item->mediaContent}}" medium="image"/>
                <image_link>{{$item->mediaContent}}</image_link>
                <image>{{$item->mediaContent}}</image>
                <price>{{$item->price}}</price>
                <condition>new</condition>
                <availability>in stock</availability>
            </item>
        @endforeach
    </channel>
</rss>
