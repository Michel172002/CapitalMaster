@props([
    'infos' => [],
])
<div
    x-data="{
        currentInfo: 0,
        totalInfos: {{ count($infos) }},
        interval: 10000,
        intervalId: null,
        initInterval: function() {
            this.intervalId = setInterval(() => {
                if (this.currentInfo === this.totalInfos - 1) {
                    this.currentInfo = 0;
                } else {
                    this.currentInfo++;
                }
            }, this.interval);
        },
        stopInterval: function() {
            clearInterval(this.intervalId);
        },
        init() {
            this.initInterval();
        }
    }"
    class="w-[65%] h-full flex flex-col items-center justify-center p-8"
>
    <div class="w-full h-full bg-linear-to-t from-primary-300 to-secundary-400 shadow-lg rounded-3xl py-8 px-24 overflow-hidden">
        <div class="relative w-full h-full">
            @foreach($infos as $info)
                <div 
                    x-show="currentInfo === {{ $loop->index }}" 
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="transform translate-x-full opacity-0"
                    x-transition:enter-end="transform translate-x-0 opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform -translate-x-full opacity-0"
                    class="absolute inset-0 w-full h-full flex flex-col items-center justify-center" 
                    x-on:mouseenter="stopInterval()" 
                    x-on:mouseleave="initInterval()"
                >
                    <div class="w-full h-full flex flex-col items-center justify-center gap-3">
                        <h1 class="text-4xl font-bold text-center text-white transform transition-all duration-500">
                            <span>{{ $info['title'] }}</span>
                        </h1>
                        <p class="text-normal text-center text-white font-medium uppercase transform transition-all duration-500">
                            <span>{{ $info['description'] }}</span>
                        </p>
                        <img src="{{ asset($info['image']) }}" 
                             class="size-[450px] my-auto transform transition-all duration-500"">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="w-full flex items-center justify-center gap-4">
            @foreach($infos as $info)
                <div class="w-18 bg-white cursor-pointer transition-all duration-300 ease-in-out rounded-full" 
                     x-on:click="currentInfo = {{ $loop->index }}; stopInterval(); initInterval();"
                     :class="{
                        'h-1 opacity-60' : currentInfo != '{{ $loop->index }}',
                        'h-2 opacity-100' : currentInfo == '{{ $loop->index }}'
                    }"
                ></div>
            @endforeach
        </div>
    </div>
</div>