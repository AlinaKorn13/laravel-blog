<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-hidden rounded-lg shadow-lg">
                        <div
                            class="bg-neutral-50 py-3 px-5 dark:bg-neutral-700 dark:text-neutral-200">
                            Line chart
                        </div>
                        <canvas class="p-10" id="chartLine"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart line -->
<script>
    const labels = {!! $months !!} ;
    const data = {
        labels: labels,
        datasets: [
            {
                label: "Posts per month",
                backgroundColor: "hsl(217, 57%, 51%)",
                borderColor: "hsl(217, 57%, 51%)",
                data: {!! $posts !!},
            },
            {
                label: "Likes per month",
                backgroundColor: "hsl(346,57%,51%)",
                borderColor: "hsl(346,57%,51%)",
                data: {!! $likes !!},
            },
            {
                label: "Views per month",
                backgroundColor: "hsl(25,57%,51%)",
                borderColor: "hsl(25,57%,51%)",
                data: {!! $views !!},
            },
            {
                label: "Comments per month",
                backgroundColor: "hsl(246,80%,27%)",
                borderColor: "hsl(246,80%,27%)",
                data: {!! $comments !!},
            },
        ],
    };

    const configLineChart = {
        type: "line",
        data,
        options: {},
    };

    var chartLine = new Chart(
        document.getElementById("chartLine"),
        configLineChart
    );
</script>
