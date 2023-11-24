<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mick Redman : Effective Web Designs</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}" />
</head>

<body class="antialiased bg-slate-900 text-slate-300 container mx-auto">
    <header class="flex flex-col items-center pb-4">
        <h1 class="text-4xl m-4">Mick Redman</h1>
    </header>
    <main class="flex flex-col items-center">
        <div id="descriptionContainer" class="text-left">
            <p>This small application performs a few small tasks:</p>
            <ul>
                <li>It pulls content from <a href="https://effectivewebdesigns.blogspot.com/" target="_blank" rel="noopener noreferrer">my blog</a> using the Blogger API.</li>
                <li>It accepts phrases typed into the search box below.</li>
                <li>It makes suggestions through the blog entry title for the next step, and allows the user to select one of those titles.</li>
                <li>Once a title has been selected, it is used to provide results from the Brave search API.</li>
                <li>The results are also links.</li>
            </ul>
            <p>See the code for this site on <a href="https://github.com/guitarbeerchocolate/ewd-demo" target="_blank" rel="noopener noreferrer">GitHub</a></p>
        </div>
        <form action="{{ route('search-results') }}" method="GET">
            <input type="text" name="query" id="search-input" placeholder="Search..." class="text-slate-900 p-2">
            <div id="suggestions-container"></div>
        </form>
        <div id="selected-suggestion" class="bg-slate-800 p-2 mt-4"></div>
        <div id="brave-container" class="bg-slate-800 p-2 mt-4"></div>
    </main>
    <footer class="flex flex-col items-center">

    </footer>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>