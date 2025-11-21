<?php

namespace App\Services;

use App\Models\Module;

class ModuleService
{
    public function getAll()
    {
        return Module::with(['mentor', 'category'])->get();
    }

    public function store(array $data)
    {
        return Module::create($data);
    }

    public function update(Module $module, array $data)
    {
        $module->update($data);
        return $module;
    }

    public function delete(Module $module)
    {
        return $module->delete();
    }
}
