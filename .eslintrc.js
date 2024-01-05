module.exports = {
    root: true,
    extends: [
        'eslint:recommended',
        'plugin:@typescript-eslint/eslint-recommended',
        'plugin:vue/vue3-recommended',
        'plugin:prettier/recommended',
        './.eslintrc-auto-import.json',
    ],
    env: {
        browser: true,
        node: true,
    },
    ignorePatterns: ['*.d.ts'],
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@typescript-eslint/parser',
        sourceType: 'module',
        ecmaVersion: 2022,
        warnOnUnsupportedTypeScriptVersion: false,
    },
    plugins: ['@typescript-eslint', 'prettier', 'promise'],
    rules: {
        'arrow-body-style': 'off',
        'comma-dangle': ['error', 'always-multiline'],
        'prettier/prettier': 'warn',
        'prefer-arrow-callback': 'off',
        'vue/component-name-in-template-casing': ['error', 'PascalCase'],
        'vue/component-tags-order': [
            'error',
            {
                order: ['template', 'script', 'style'],
            },
        ],
        'vue/define-macros-order': [
            'warn',
            {
                order: ['defineProps', 'defineEmits'],
            },
        ],
        'vue/multi-word-component-names': 'off',
        'vue/no-reserved-component-names': 'off',
        'vue/no-template-target-blank': [
            'error',
            {
                allowReferrer: false,
                enforceDynamicLinks: 'always',
            },
        ],
        'vue/no-ref-object-destructure': 'error',
        'vue/no-unused-refs': 'warn',
        'vue/no-useless-v-bind': 'error',
        'vue/prefer-true-attribute-shorthand': 'error',
        'vue/no-v-html': 'off',
        'no-undef': 'off',
        'no-unused-vars': 'off',
        'no-console': ['warn'],
    },
    globals: {
        Vue: 'readable',
    },
}
