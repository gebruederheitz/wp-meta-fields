import babel from '@rollup/plugin-babel';
import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import terser from '@rollup/plugin-terser';

const babelConfig = {
    babelrc: false,
    exclude: [/\/core-js\//, 'node_modules/**'],
    sourceMaps: true,
    inputSourceMap: true,
    babelHelpers: 'bundled',
    presets: [
        [
            '@babel/preset-env',
            {
                useBuiltIns: 'usage',
                corejs: 3,
            }
        ],
    ],
};

export default [
    {
        external: [
            'wp',
        ],
        input: 'src/media-upload.js',
        output: {
            file: 'dist/media-upload.js',
            format: 'umd',
            name: 'ghmetafields_media_upload',
            globals: {
                wp: 'wp',
            },
        },
        plugins: [
            resolve(),
            babel(babelConfig),
            commonjs(),
            terser(),
        ],
    },
];
