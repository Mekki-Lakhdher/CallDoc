/**
 * Created by Mekki on 06/11/2020.
 */
module.exports = {
    extends: ['eslint:recommended','plugin:react/recommended'],
    parserOptions: {
        ecmaVersion: 6,
        sourceType: 'module',
        ecmaFeatures: {
            jsx: true
        }
    },
    env: {
        browser: true,
        es6: true,
        node: true,
        jquery: true
    },
    rules: {
        "no-console": 0,
        "no-unused-vars": 0
    }
};