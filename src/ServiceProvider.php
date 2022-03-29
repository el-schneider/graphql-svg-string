<?php

namespace ElSchneider\GraphqlSvgString;

use Statamic\Facades\GraphQL;
use Statamic\Assets\Asset;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
        GraphQL::addField(
            "AssetInterface",
            'svgString',
            function () {
                return [
                    "type" => GraphQL::type('String'),
                    "resolve" => function (Asset $asset) {
                        if ($asset->extension() === 'svg') {
                            return $asset->contents();
                        }
                        return null;
                    }
                ];
            }
        );
    }
}
