<template>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center">
                <h2 class="mb-4 text-lg font-semibold leading-8 tracking-tight text-indigo-600">
                    Quotes
                </h2>
                <button
                    type="button"
                    class="rounded border border-transparent bg-black px-4 py-2 text-center text-sm font-semibold text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    @click="refreshQuotes"
                >
                    Refresh Quotes
                </button>
            </div>
            <div
                v-if="data.quotes.length"
                class="mx-auto mt-16 flow-root max-w-2xl sm:mt-20 lg:mx-0 lg:max-w-none"
            >
                <div class="-mt-8 sm:-mx-4 sm:columns-2 sm:text-[0] lg:columns-3">
                    <div
                        v-for="quote in data.quotes"
                        :key="quote.id"
                        class="pt-8 sm:inline-block sm:w-full sm:px-4"
                    >
                        <figure class="rounded-2xl bg-gray-50 p-8 text-sm leading-6">
                            <blockquote class="text-gray-900">
                                <p>{{ `“${quote.quote}”` }}</p>
                            </blockquote>
                        </figure>
                    </div>
                </div>
            </div>
            <button
                v-else
                type="button"
                class="relative mt-16 block w-full rounded-lg border-2 border-dashed border-gray-300 p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                @click.prevent="refreshQuotes"
            >
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    stroke="currentColor"
                    fill="none"
                    viewBox="0 0 48 48"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 14v20c0 4.418 7.163 8 16 8 1.381 0 2.721-.087 4-.252M8 14c0 4.418 7.163 8 16 8s16-3.582 16-8M8 14c0-4.418 7.163-8 16-8s16 3.582 16 8m0 0v14m0-4c0 4.418-7.163 8-16 8S8 28.418 8 24m32 10v6m0 0v6m0-6h6m-6 0h-6"
                    />
                </svg>
                <span class="mt-2 block text-sm font-semibold text-gray-900">Fetch new quotes</span>
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
const data = reactive<{ quotes: Array<App.Quote> }>({ quotes: [] })

onMounted(() => {
    useAxios()
        .get(route('quotes.index'), {
            headers: { Authorization: `Bearer ${useCurrentAccessToken.value}` },
        })
        .then((response: any) => {
            if (response.data.data.length) {
                data.quotes = response.data.data
            } else {
                refreshQuotes()
            }
        })
})

function refreshQuotes() {
    useAxios()
        .get(route('quotes.refresh'), {
            headers: { Authorization: `Bearer ${useCurrentAccessToken.value}` },
        })
        .then((response: any) => {
            data.quotes = response.data.data
        })
}
</script>
