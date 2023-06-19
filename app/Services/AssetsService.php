<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class AssetsService
{
    /**
     * @var Asset
     */
    protected $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function create($request)
    {
        $user = User::find($request->user_id);
        if ($user === null) {
            return null;
        }
        $asset = Asset::create([
            'name' => $request->name,
            'code' => $request->code,
            'location' => $request->location,
            'user_id' => $request->user_id,
        ]);
        return $asset;
    }

    public function edit($id, array $payload)
    {
        $asset = Asset::find($id);
        return $asset->update($payload);
    }


    public function deleteId($id)
    {
        $asset = Asset::find($id);
        return $asset->delete();
    }

    public function getById($id)
    {
        $asset = Asset::find($id);
        return $asset;
    }

    public function getByUserId($id)
    {
        $assets = Asset::where('user_id', $id)->get();
        return $assets;
    }
}
