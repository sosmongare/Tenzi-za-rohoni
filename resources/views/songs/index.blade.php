<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenzi Za Rohoni - Collection of Hymns</title>
    <meta name="description" content="Explore a collection of hymns from Tenzi Za Rohoni. Search and read the lyrics of various hymns.">
    <meta name="keywords" content="Tenzi Za Rohoni, hymns, lyrics, music, worship, praise">
    <meta name="author" content="Sospeter Mongare">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Tenzi Za Rohoni - Collection of Hymns">
    <meta property="og:description" content="Explore a collection of hymns from Tenzi Za Rohoni. Search and read the lyrics of various hymns.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.yourwebsite.com/tenzi-za-rohoni">
    <meta property="og:image" content="https://www.yourwebsite.com/images/tenzi-za-rohoni.jpg">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Tenzi Za Rohoni - Collection of Hymns">
    <meta name="twitter:description" content="Explore a collection of hymns from Tenzi Za Rohoni. Search and read the lyrics of various hymns.">
    <meta name="twitter:image" content="https://www.yourwebsite.com/images/tenzi-za-rohoni.jpg">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Tenzi Za Rohoni</h1>
        <input type="text" id="searchInput" class="form-control mb-4" placeholder="Search for a hymn">

        <p>Number of visits: {{ $visit->count ?? 0 }}</p>
        <div class="accordion" id="hymnAccordion">
            @foreach($hymns as $hymn)
                <div class="card hymn-card">
                    <div class="card-header" id="heading{{ $hymn['song_number'] }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link hymn-title" type="button" data-toggle="collapse" data-target="#collapse{{ $hymn['song_number'] }}" aria-expanded="true" aria-controls="collapse{{ $hymn['song_number'] }}">
                                {{ $hymn['song_number']. '. ' .$hymn['title'] }} @if(isset($hymn['subtitle'])) - {{ $hymn['subtitle'] }} @endif
                            </button>
                        </h2>
                    </div>

                <div id="collapse{{ $hymn['song_number'] }}" class="collapse" aria-labelledby="heading{{ $hymn['song_number'] }}" data-parent="#hymnAccordion">
                        <div class="card-body">
                            @foreach($hymn as $key => $value)
                                @if(strpos($key, 'stanza_') === 0)
                                    <h3>{{ ucfirst(str_replace('_', ' ', $key)) }}</h3>
                                    @foreach($value as $stanzaLine)
                                        <p>{{ $stanzaLine }}</p>
                                    @endforeach
                                @elseif(strpos($key, 'chorus') !== false)
                                    <h3>{{ ucfirst(str_replace('_', ' ', $key)) }}</h3>
                                    <ul>
                                        @foreach($value as $chorusLine)
                                            <li>{{ $chorusLine }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <script src="{{ asset('assets/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('.hymn-card').each(function() {
                    var hymnTitle = $(this).find('.hymn-title').text().toLowerCase();
                    if (hymnTitle.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
</body>
</html>

