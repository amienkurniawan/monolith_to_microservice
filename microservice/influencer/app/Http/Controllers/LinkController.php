<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
// use App\Jobs\LinkCreated;
use App\Models\Link;
use App\Models\LinkProduct;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Microservices\UserServices;

class LinkController
{
    private $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function store(Request $request)
    {
        $user = $this->userServices->getUser();

        $link = Link::create(
            [
                'user_id' => $user->id,
                'code' => Str::random(6)
            ]
        );
        $linkProducts = [];
        foreach ($request->input('products') as $product_id) {
            $linkProduct = LinkProduct::create([
                'link_id' => $link->id,
                'product_id' => $product_id
            ]);
            $linkProducts[] = $linkProduct->toArray();
        }
        // LinkCreated::dispatch($link, $linkProducts);
        return new LinkResource($link);
    }
}
