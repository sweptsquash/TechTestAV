import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import inertiaLayout from 'momentum-layout'
import autoimport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import { defineConfig, loadEnv } from 'vite'
import manifestSRI from 'vite-plugin-manifest-sri'
import { watch } from 'vite-plugin-watch'

export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }

    return defineConfig({
        css: {
            devSourcemap: process.env.VITE_ENV !== 'production',
        },
        resolve: {
            alias: {
                '@': '/resources/js',
                '~': '/node_modules',
            },
        },
        plugins: [
            autoimport({
                eslintrc: {
                    enabled: true,
                },
                vueTemplate: true,
                dts: 'resources/js/Types/auto-imports.d.ts',
                dirs: ['resources/js/Composables'],
                imports: [
                    'vue',
                    { 'momentum-trail': ['route', 'current'] },
                    { '@inertiajs/vue3': ['router', 'useForm', 'usePage'] },
                ],
            }),
            Components({
                dirs: ['resources/js/Components'],
                dts: 'resources/js/Types/auto-components.d.ts',
                resolvers: [
                    (name: string) => {
                        const components = {
                            InertiaLink: { component: 'Link', lib: '@inertiajs/vue3' },
                            InertiaHead: { component: 'Head', lib: '@inertiajs/vue3' },
                        }

                        if (name in components) {
                            return {
                                name: components[name]?.component,
                                from: components[name]?.lib,
                            }
                        }
                    },
                ],
            }),
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.ts'],
                ssr: 'resources/js/ssr.ts',
                refresh: ['routes/**', 'resources/css/**', 'resources/js/**'],
                valetTls: process.env.VITE_VALET_TLS ? 'app.test' : undefined,
            }),
            inertiaLayout(),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            watch({
                pattern: 'routes/**/*.php',
                command: 'php artisan trail:generate',
            }),
            manifestSRI(),
        ],
        ssr: {
            noExternal: ['@inertiajs/vue3/server'],
        },
    })
}
