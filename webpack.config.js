let mix = require('laravel-mix');

mix.js('src/app.js', 'dist')
    .sass('src/app.scss', 'dist')
    .setPublicPath('dist');

const { assertSupportedNodeVersion } = require('../src/Engine');

module.exports = async () => {
    // @ts-ignore
    process.noDeprecation = true;

    assertSupportedNodeVersion();

    const mix = require('../src/Mix').primary;

    require(mix.paths.mix());

    await mix.installDependencies();
    await mix.init();

    return mix.build();
};
