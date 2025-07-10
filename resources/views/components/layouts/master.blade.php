<x-partials.header/>

<header>
    <x-partials.navbar/>
</header>
<!--  -->
<aside id="default-sidebar" class="fixed md:block top-0 left-0 z-40 pt-14 w-64 h-screen transition-transform -translate-x-full" aria-label="Sidenav">
    <x-partials.sidebar/>
</aside>
<!--  -->

<div class="mt-16 mb-4 mx-2 p-4 border-2 border-gray-500 border-dashed rounded-lg">
{{ $slot }}
</div>
<x-partials.footer/>