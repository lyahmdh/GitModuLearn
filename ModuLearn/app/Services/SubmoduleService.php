<?php

namespace App\Services;

use App\Models\Submodule;
use App\Models\Module;

class SubmoduleService
{
    public function create(array $data)
    {
        return Submodule::create($data);
    }

    public function update(Submodule $submodule, array $data)
    {
        $submodule->update($data);
        return $submodule;
    }

    public function delete(Submodule $submodule)
    {
        return $submodule->delete();
    }

    public function getByModule(Module $module)
    {
        return $module->submodules()->orderBy('order')->get();
    }

    public function getById($id)
    {
        return Submodule::findOrFail($id);
    }
}
