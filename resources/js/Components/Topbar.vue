<template>
    <div
        class="w-full py-4 flex justify-between items-center bg-zinc-950 text-white px-7"
    >
        <div class="flex gap-4 items-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-sun w-5 stroke-yellow-200"
            >
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2" />
                <path d="M12 20v2" />
                <path d="m4.93 4.93 1.41 1.41" />
                <path d="m17.66 17.66 1.41 1.41" />
                <path d="M2 12h2" />
                <path d="M20 12h2" />
                <path d="m6.34 17.66-1.41 1.41" />
                <path d="m19.07 4.93-1.41 1.41" />
            </svg>
            <span v-if="isLoading.temperature">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    class="animate-spin"
                >
                    <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                </svg>
            </span>
            <span v-else>{{ temperature }} ºC</span>
            <hr class="h-5 w-0.5 bg-white hidden md:block" />
            <span v-if="isLoading.date" class="hidden md:block">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    class="animate-spin"
                >
                    <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                </svg>
            </span>
            <span v-else class="hidden md:block">{{ date }}</span>
        </div>
        <div class="flex gap-4 items-center">
            <span v-if="isLoading.time">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    class="animate-spin"
                >
                    <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                </svg>
            </span>
            <span v-else>{{ time }} h</span>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const isLoading = ref({
    temperature: true,
    date: true,
    time: true
});

const temperature = ref("");
const date = ref("");
const time = ref("");

async function getData() {
    await axios.get("/api/environment/temperature").then((response) => {
        temperature.value = response.data.temperature;
        isLoading.value.temperature = false;
    });

    await axios.get("/api/environment/date").then((response) => {
        date.value = response.data.date;
        isLoading.value.date = false;
    });

    const currentTime = new Date().toLocaleTimeString();
    time.value = currentTime.split(":").slice(0, 2).join(":");
    isLoading.value.time = false;
}

onMounted(() => {
    getData();

    setInterval(() => {
        getData();
    }, 1000);
});
</script>
