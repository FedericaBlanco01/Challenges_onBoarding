<!doctype html>

<title>Flight</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 ">

        <nav class="flex items-center justify-between flex-wrap p-6 " aria-label="header">
            <div class="flex items-center flex-shrink-0 mr-6">
                <a href="/">
                    <img src="{{URL::asset('/image/Fly_Me.png')}}" alt="logo" width="150" height="150">
                </a>
            </div>

{{--            <div class="mr-6">--}}
{{--                <a href="/">--}}
{{--            <span class="font-semibold text-xl tracking-tight text-black">Flight</span>--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto ">
                <div class="text-2sm lg:flex-grow ">
                    <a href="/cities"
                        class="block mt-4 lg:inline-block text-xl lg:mt-0 hover:text-white mr-4">
                        Cities
                    </a>
                    <a href="/airlines"
                        class="block mt-4 lg:inline-block text-xl lg:mt-0 hover:text-white mr-4">
                        Airlines
                    </a>
                    <a href="#responsive-header"
                        class="block mt-4 lg:inline-block text-xl lg:mt-0 hover:text-white mr-4">
                        Flights
                    </a>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="{{URL::asset('/image/bye.png')}}" alt="come_back_soon" class="mx-auto -mb-6" style="width: 100px;">
            <h5 class="text-xl py-8">Ready to take-off? </h5>
            <p class="text-sm mt-3">Stay in touch with the latest updates!</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="#" class="lg:flex text-sm">
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" type="text" placeholder="Your email address"
                                class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit"
                            class="transition-colors duration-300 bg-purple-400 hover:bg-purple-800 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                            Subscribe
                        </button>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                        @yield('scripts')

                    </form>
                </div>
            </div>
        </footer>
    </section>
</body>
