<script setup>
import { Head } from '@inertiajs/vue3';
import Topbar from '@/Components/Topbar.vue';
import PoolMetrics from '@/Components/PoolMetrics.vue';
import Buttons from '@/Components/Buttons.vue';
</script>

<!-- -->

<template>
    <Head title="UI" />
    
    <div class="flex flex-col w-screen h-screen bg-[#121928]">
        <Topbar />
        <div class="flex flex-row justify-center items-center m-4 gap-3">
            <div class="flex flex-col gap-2">
                <PoolMetrics />
                <Buttons />
            </div>
            <button class="bg-[#263654] h-full w-12 flex items-center justify-center rounded-xl">
                <p class="rotate-text text-white">ABRIR ASSISTENTE</p>
            </button>
        </div>
    </div>
</template>

<style scoped>
    .rotate-text {
        writing-mode: vertical-lr;
        text-orientation: sideways-right;
        transform: rotate(0deg);
    }
</style>