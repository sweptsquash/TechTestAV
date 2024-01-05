export const useUser = computed(() => usePage().props.user ?? null)

export const useCurrentAccessToken = computed(() => usePage().props.token ?? null)
