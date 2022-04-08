<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laraclassifier/laraclassifier';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'asm89/stack-cors' => 'v2.0.3@9cb795bf30988e8c96dd3c40623c48a877bc6714',
  'aws/aws-crt-php' => 'v1.0.2@3942776a8c99209908ee0b287746263725685732',
  'aws/aws-sdk-php' => '3.208.7@41a800dd7cf5c4ac0ef9bf8db01e838ab6a3698c',
  'brick/math' => '0.9.3@ca57d18f028f84f777b2168cd1911b0dee2343ae',
  'chriskonnertz/open-graph' => 'v2.0.0@75d2b5afeddd255bcf5d823cbe64f3623da3e01c',
  'clue/stream-filter' => 'v1.5.0@aeb7d8ea49c7963d3b581378955dbf5bc49aa320',
  'cocur/slugify' => 'v4.0.0@3f1ffc300f164f23abe8b64ffb3f92d35cec8307',
  'composer/ca-bundle' => '1.3.1@4c679186f2aca4ab6a0f1b0b9cf9252decb44d0b',
  'composer/package-versions-deprecated' => '1.11.99.4@b174585d1fe49ceed21928a945138948cb394600',
  'cviebrock/eloquent-sluggable' => '8.0.8@16e21db24d80180f870c3c7c4faf3d3af23f4117',
  'dflydev/dot-access-data' => 'v3.0.1@0992cc19268b259a39e86f296da5f0677841f42c',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '2.13.6@67ef6d0327ccbab1202b39e0222977a47ed3ef2f',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '2.0.4@8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dragonmantank/cron-expression' => 'v3.1.0@7a8c6e56ab3ffcc538d05e8155bb42269abf1a0c',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'ezyang/htmlpurifier' => 'v4.13.0@08e27c97e4c6ed02f37c5b2b20488046c8d90d75',
  'fakerphp/faker' => 'v1.17.0@b85e9d44eae8c52cca7aa0939483611f7232b669',
  'fideloper/proxy' => '4.4.1@c073b2bd04d1c90e04dc1b787662b558dd65ade0',
  'florianv/exchanger' => '2.7.2@9e632ab8ab8b32c52628d775bbf21125d2c4d3af',
  'florianv/laravel-swap' => '2.3.0@e88b79a4921d07f683182aaf0279568ced3c0acd',
  'florianv/swap' => '4.3.0@88edd27fcb95bdc58bbbf9e4b00539a2843d97fd',
  'fruitcake/laravel-cors' => 'v2.0.4@a8ccedc7ca95189ead0e407c43b530dc17791d6a',
  'geoip2/geoip2' => 'v2.12.2@83adb44ac4b9553d36b579a14673ed124583082f',
  'giggsey/libphonenumber-for-php' => '8.12.40@cafb3497dce678e9643ec3eba38be251a67d7469',
  'giggsey/locale' => '2.1@8d324583b5899e6280a875c43bf1fc9658bc6962',
  'gliterd/backblaze-b2' => '1.5.1@568b9513a040712f3a8a737b7d107cce3c45c2e7',
  'graham-campbell/flysystem' => 'v7.1.2@923fdb238bf668004824a8daee2cb2e1e29504ac',
  'graham-campbell/guzzle-factory' => 'v5.0.3@f93cfbffd422920f5d9915ec7d682f030ddffda6',
  'graham-campbell/manager' => 'v4.6.1@c5c89d02fd6125b121c58245caf4b918a413d4be',
  'graham-campbell/result-type' => 'v1.0.4@0690bde05318336c7221785f2a932467f98b64ca',
  'guzzlehttp/guzzle' => '7.4.1@ee0a041b1760e6a53d2a39c8c34115adc2af2c79',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '2.1.0@089edd38f5b8abba6cb01567c2a8aaa47cec4c72',
  'intervention/image' => '2.7.1@744ebba495319501b873a4e48787759c72e3fb8c',
  'iyzico/iyzipay-php' => 'v2.0.51@fa2a07634cfc099ca47d5397ef6591d06b31cbb4',
  'jackiedo/dotenv-editor' => '1.2.0@f93690a80915d51552931d9406d79b312da226b9',
  'jaybizzle/crawler-detect' => 'v1.2.110@f9d63a3581428fd8a3858e161d072f0b9debc26f',
  'jaybizzle/laravel-crawler-detect' => 'v1.2.0@e39b536fb5e4f21a49328e83a2ab26f0b64b06f7',
  'lab404/laravel-impersonate' => '1.7.2@14de9dbf3446406282fa16f7920a8049860b3832',
  'laminas/laminas-diactoros' => '2.8.0@0c26ef1d95b6d7e6e3943a243ba3dc0797227199',
  'laracasts/flash' => '3.2@76c2e200498795bdbeda97b682536130316e8b97',
  'laravel-notification-channels/twilio' => '3.1.2@509c76853124418ca21f3257c0c832cc5018cfd2',
  'laravel/framework' => 'v8.77.1@994dbac5c6da856c77c81a411cff5b7d31519ca8',
  'laravel/helpers' => 'v1.4.1@febb10d8daaf86123825de2cb87f789a3371f0ac',
  'laravel/nexmo-notification-channel' => 'v2.5.1@178c9f0eb3a18d4b5682471bffca104a15d817a7',
  'laravel/sanctum' => 'v2.13.0@b4c07d0014b78430a3c827064217f811f0708eaa',
  'laravel/serializable-closure' => 'v1.0.5@25de3be1bca1b17d52ff0dc02b646c667ac7266c',
  'laravel/slack-notification-channel' => 'v2.3.1@f428e76b8d0a0a2ff413ab225eeb829b9a8ffc20',
  'laravel/socialite' => 'v5.2.6@b5c67f187ddcf15529ff7217fa735b132620dfac',
  'laravel/tinker' => 'v2.6.3@a9ddee4761ec8453c584e393b393caff189a3e42',
  'laravelcollective/html' => 'v6.2.1@ae15b9c4bf918ec3a78f092b8555551dd693fde3',
  'lcobucci/clock' => '2.0.0@353d83fe2e6ae95745b16b3d911813df6a05bfb3',
  'lcobucci/jwt' => '4.1.5@fe2d89f2eaa7087af4aa166c6f480ef04e000582',
  'league/commonmark' => '2.1.0@819276bc54e83c160617d3ac0a436c239e479928',
  'league/config' => 'v1.1.1@a9d39eeeb6cc49d10a6e6c36f22c4c1f4a767f3e',
  'league/csv' => '9.7.4@002f55f649e7511710dc7154ff44c7be32c8195c',
  'league/flysystem' => '1.1.9@094defdb4a7001845300334e7c1ee2335925ef99',
  'league/flysystem-aws-s3-v3' => '1.0.29@4e25cc0582a36a786c31115e419c6e40498f6972',
  'league/flysystem-cached-adapter' => '1.1.0@d1925efb2207ac4be3ad0c40b8277175f99ffaff',
  'league/flysystem-sftp' => '1.0.22@cab59dd2277e02fe46f5f23195672a02ed49774d',
  'league/iso3166' => '4.0.0@1a3ec7e6f1e4f16fce68dc239bafae217fbdcfef',
  'league/mime-type-detection' => '1.9.0@aa70e813a6ad3d1558fc927863d47309b4c23e69',
  'league/oauth1-client' => 'v1.10.0@88dd16b0cff68eb9167bfc849707d2c40ad91ddc',
  'livecontrol/eloquent-datatable' => 'dev-master@49cb344f73165763734b968248da7bc1bdc7b8e9',
  'maxmind-db/reader' => 'v1.11.0@b1f3c0699525336d09cc5161a2861268d9f2ae5b',
  'maxmind/web-service-common' => 'v0.8.1@32f274051c543fc865e5a84d3a2c703913641ea8',
  'mews/purifier' => '3.3.6@1d033fc32b98036226002c38747d4a45424d5f28',
  'mhetreramesh/flysystem-backblaze' => '1.6.1@9bbe64c161519c20e508d2c924d507d892999e5d',
  'mikey179/vfsstream' => 'v1.6.10@250c0825537d501e327df879fb3d4cd751933b85',
  'monolog/monolog' => '2.3.5@fd4380d6fc37626e2f799f29d91195040137eba9',
  'mtdowling/jmespath.php' => '2.6.1@9b87907a81b87bc76d19a7fb2d61e61486ee9edb',
  'nesbot/carbon' => '2.55.2@8c2a18ce3e67c34efc1b29f64fe61304368259a2',
  'nette/schema' => 'v1.2.2@9a39cef03a5b34c7de64f551538cbba05c2be5df',
  'nette/utils' => 'v3.2.6@2f261e55bd6a12057442045bf2c249806abc1d02',
  'nexmo/laravel' => '2.4.1@029bdc19fc58cd6ef0aa75c7041d82b9d9dc61bd',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'openpayu/openpayu' => '2.3.3@8cb4103314b4bccf6a8a8ba13be54dd6fd51e5aa',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'paypal/paypal-checkout-sdk' => '1.0.2@19992ce7051ff9e47e643f28abb8cc1b3e5f1812',
  'paypal/paypalhttp' => '1.0.1@7b09c89c80828e842c79230e7f156b61fbb68d25',
  'php-http/discovery' => '1.14.1@de90ab2b41d7d61609f504e031339776bc8c7223',
  'php-http/guzzle6-adapter' => 'dev-master@078c60727138c38471c00a321183e1dc01662152',
  'php-http/httplug' => '2.2.0@191a0a1b41ed026b717421931f8d3bd2514ffbf9',
  'php-http/message' => '1.12.0@39eb7548be982a81085fe5a6e2a44268cd586291',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpoption/phpoption' => '1.8.1@eab7a0df01fe2344d172bff4cd6dbd3f8b84ad15',
  'phpseclib/phpseclib' => '2.0.35@4e16cf3f5f927a7d3f5317820af795c0366c0420',
  'predis/predis' => 'v1.1.9@c50c3393bb9f47fa012d0cdfb727a266b0818259',
  'prologue/alerts' => '0.4.8@a6412e318c0171526bc8b25ef597f2cc61f5b800',
  'propaganistas/laravel-phone' => '4.3.5@90ea4906a67ecbfd6255f9f77806401a81e2d6ac',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.12@a0d9981aa07ecfcbea28e4bfa868031cca121e7d',
  'pulkitjalan/geoip' => '5.1.0@765c2860101abfddf18b0fc67e896548ad962a9a',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.2.2@cccc74ee5e328031b15640b51056ee8d3bb66c0a',
  'ramsey/uuid' => '4.2.3@fc9bb7fb5388691fd7373cd44dcb4d63bbcf24df',
  'spatie/db-dumper' => '2.21.1@05e5955fb882008a8947c5a45146d86cfafa10d1',
  'spatie/dropbox-api' => '1.19.1@0ea6d08445b339241d21b833db111d371e61ed4f',
  'spatie/flysystem-dropbox' => '1.2.3@8b6b072f217343b875316ca6a4203dd59f04207a',
  'spatie/laravel-backup' => '6.14.4@54bdd6d1f460ff16dc1322bbb249be46b2b28b7b',
  'spatie/laravel-cookie-consent' => '2.12.13@8e93b9efee3a68960e5c832f937170c2fc0b2f37',
  'spatie/laravel-feed' => '2.7.1@ade035d105aa152e08f7e755392e2d8e0ec1a7c5',
  'spatie/laravel-permission' => '3.18.0@1c51a5fa12131565fe3860705163e53d7a26258a',
  'spatie/laravel-translatable' => '4.6.0@5900d6002a5795712058a04c7ca7c2c44b3e0850',
  'spatie/temporary-directory' => '1.3.0@f517729b3793bca58f847c5fd383ec16f03ffec6',
  'stripe/stripe-php' => 'v7.108.0@81524a3087612f1b41846b9cd6deb80150af985b',
  'swiftmailer/swiftmailer' => 'v6.3.0@8a5d5072dca8f48460fce2f4131fcc495eec654c',
  'symfony/console' => 'v5.4.1@9130e1a0fc93cb0faadca4ee917171bd2ca9e5f4',
  'symfony/css-selector' => 'v5.4.0@44b933f98bb4b5220d10bed9ce5662f8c2d13dcc',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/error-handler' => 'v5.4.1@1e3cb3565af49cd5f93e5787500134500a29f0d9',
  'symfony/event-dispatcher' => 'v5.4.0@27d39ae126352b9fa3be5e196ccf4617897be3eb',
  'symfony/event-dispatcher-contracts' => 'v2.5.0@66bea3b09be61613cd3b4043a65a8ec48cfa6d2a',
  'symfony/finder' => 'v5.4.0@d2f29dac98e96a98be467627bd49c2efb1bc2590',
  'symfony/http-foundation' => 'v5.4.1@5dad3780023a707f4c24beac7d57aead85c1ce3c',
  'symfony/http-kernel' => 'v5.4.1@2bdace75c9d6a6eec7e318801b7dc87a72375052',
  'symfony/mime' => 'v5.4.0@d4365000217b67c01acff407573906ff91bcfb34',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-iconv' => 'v1.23.0@63b5bb7db83e5673936d6e3b8b3e022ff6474933',
  'symfony/polyfill-intl-grapheme' => 'v1.23.1@16880ba9c5ebe3642d1995ab866db29270b36535',
  'symfony/polyfill-intl-idn' => 'v1.23.0@65bd267525e82759e7d8c4e8ceea44f398838e65',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6',
  'symfony/polyfill-php72' => 'v1.23.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be',
  'symfony/polyfill-php81' => 'v1.23.0@e66119f3de95efc359483f810c4c3e6436279436',
  'symfony/process' => 'v5.4.0@5be20b3830f726e019162b26223110c8f47cf274',
  'symfony/routing' => 'v5.4.0@9eeae93c32ca86746e5d38f3679e9569981038b1',
  'symfony/service-contracts' => 'v2.5.0@1ab11b933cd6bc5464b08e81e2c5b07dec58b0fc',
  'symfony/string' => 'v5.4.0@9ffaaba53c61ba75a3c7a3a779051d1e9ec4fd2d',
  'symfony/translation' => 'v5.4.1@8c82cd35ed861236138d5ae1c78c0c7ebcd62107',
  'symfony/translation-contracts' => 'v2.5.0@d28150f0f44ce854e942b671fc2620a98aae1b1e',
  'symfony/var-dumper' => 'v5.4.1@2366ac8d8abe0c077844613c1a4f0c0a9f522dcc',
  'therobfonz/laravel-mandrill-driver' => 'v3.1.0@46aa3f532af708e8b2ad003b293875d1490c988c',
  'tijsverkoyen/css-to-inline-styles' => '2.2.4@da444caae6aca7a19c0c140f68c6182e337d5b1c',
  'torann/laravel-meta-tags' => '3.0.9@bd6ad602c3ea05f427e5f62ea65649a6ae0be6c9',
  'twilio/sdk' => '6.32.0@d4a5ad22e761a14c5e355debb88a6f17640b247c',
  'unicodeveloper/laravel-paystack' => '1.0.7@bfcb92255c29d92b0c4e80355a65de14e2e156f3',
  'vemcogroup/laravel-sparkpost-driver' => '4.0.4@56e41164236b12248e4893418319d3c30bc4e753',
  'vlucas/phpdotenv' => 'v5.4.1@264dce589e7ce37a7ba99cb901eed8249fbec92f',
  'voku/portable-ascii' => '1.5.6@80953678b19901e5165c56752d087fc11526017c',
  'vonage/client' => '2.4.0@29f23e317d658ec1c3e55cf778992353492741d7',
  'vonage/client-core' => '2.10.0@abd4047c0944416d497884f4c3c8db7a52876198',
  'vonage/nexmo-bridge' => '0.1.0@62653b1165f4401580ca8d2b859f59c968de3711',
  'watson/sitemap' => '4.0.1@9535ae419dd822661d79fb1fcbb8dcfafb777fdc',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'wildbit/swiftmailer-postmark' => '3.3.0@44ccab7834de8b220d292647ecb2cb683f9962ee',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'erusev/parsedown' => '1.7.4@cb17b6477dfff935958ba01325f2e8a2bfa6dab3',
  'facade/flare-client-php' => '1.9.1@b2adf1512755637d0cef4f7d1b54301325ac78ed',
  'facade/ignition' => '2.17.3@29f1be7f45f6fe4ffcf59a1c87bb469d47f1d227',
  'facade/ignition-contracts' => '1.0.2@3c921a1cdba35b68a7f0ccffc6dffc1995b18267',
  'filp/whoops' => '2.14.4@f056f1fe935d9ed86e698905a957334029899895',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'knuckleswtf/pastel' => '1.3.7@f26642b7f7506c3c4f17aee3e0010546ce0069d0',
  'knuckleswtf/scribe' => '2.7.10@0f0364685ed27cd9227b291da6b06039f1ae286c',
  'mnapoli/front-yaml' => '1.8.0@76baa8ca538e111bfe53ac49c6a512ec5ea2bf54',
  'mnapoli/silly' => '1.7.3@e437baa502c3e1691d342374e71446d4bac1cad5',
  'mockery/mockery' => '1.4.4@e01123a0e847d52d186c5eb4b9bf58b0c6d00346',
  'mpociot/reflection-docblock' => '1.0.1@c8b2e2b1f5cebbb06e2b5ccbf2958f2198867587',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'nunomaduro/collision' => 'v5.10.0@3004cfa49c022183395eabc6d0e5207dfe498d00',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.1.0@bae7c545bef187884426f042434e561ab1ddb182',
  'php-di/invoker' => '2.3.3@cd6d9f267d1a3474bdddf1be1da079f01b942786',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.5.1@a12f7e301eb7258bb68acd89d4aefa05c2906cae',
  'phpspec/prophecy' => 'v1.15.0@bbcd7380b0ebf3961ee21409db7b38bc31d69a13',
  'phpunit/php-code-coverage' => '9.2.10@d5850aaf931743067f4bfc1ae4cbd06468400687',
  'phpunit/php-file-iterator' => '3.0.6@cf1c2e7c203ac650e352f4cc675a7021e7d1b3cf',
  'phpunit/php-invoker' => '3.1.1@5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
  'phpunit/php-text-template' => '2.0.4@5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
  'phpunit/php-timer' => '5.0.3@5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
  'phpunit/phpunit' => '9.5.11@2406855036db1102126125537adb1406f7242fdd',
  'sebastian/cli-parser' => '1.0.1@442e7c7e687e42adc03470c7b668bc4b2402c0b2',
  'sebastian/code-unit' => '1.0.8@1fc9f64c0927627ef78ba436c9b17d967e68e120',
  'sebastian/code-unit-reverse-lookup' => '2.0.3@ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
  'sebastian/comparator' => '4.0.6@55f4261989e546dc112258c7a75935a81a7ce382',
  'sebastian/complexity' => '2.0.2@739b35e53379900cc9ac327b2147867b8b6efd88',
  'sebastian/diff' => '4.0.4@3461e3fccc7cfdfc2720be910d3bd73c69be590d',
  'sebastian/environment' => '5.1.3@388b6ced16caa751030f6a69e588299fa09200ac',
  'sebastian/exporter' => '4.0.4@65e8b7db476c5dd267e65eea9cab77584d3cfff9',
  'sebastian/global-state' => '5.0.3@23bd5951f7ff26f12d4e3242864df3e08dec4e49',
  'sebastian/lines-of-code' => '1.0.3@c1c2e997aa3146983ed888ad08b15470a2e22ecc',
  'sebastian/object-enumerator' => '4.0.4@5c9eeac41b290a3712d88851518825ad78f45c71',
  'sebastian/object-reflector' => '2.0.4@b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
  'sebastian/recursion-context' => '4.0.4@cd9d8cf3c5804de4341c283ed787f099f5506172',
  'sebastian/resource-operations' => '3.0.3@0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
  'sebastian/type' => '2.3.4@b8cd8a1c753c90bc1a0f5372170e3e489136f914',
  'sebastian/version' => '3.0.2@c6c1022351a901512170118436c764e473f6de8c',
  'shalvah/clara' => '2.6.0@f1d8a36da149b605769ef86286110e435a68d9ac',
  'symfony/var-exporter' => 'v5.4.0@d59446d6166b1643a8a3c30c2fa8e16e51cdbde7',
  'symfony/yaml' => 'v5.4.0@034ccc0994f1ae3f7499fa5b1f2e75d5e7a94efc',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'windwalker/renderer' => '3.5.23@b157f2832dac02209db032cb61e21b8264ee4499',
  'windwalker/structure' => '3.5.23@59466adb846685d60463f9c1403df2832d2fcf90',
  'laraclassifier/laraclassifier' => 'dev-main@695a5732f8bc9d368ab6a53f8f9da92f2e17d0e1',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
