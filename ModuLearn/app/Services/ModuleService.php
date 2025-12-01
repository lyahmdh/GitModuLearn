<?php

namespace App\Services;

use App\Models\Module;

class ModuleService
{
    /**
     * Ambil semua modul beserta relasi mentor, kategori, dan jumlah likes
     * Untuk dashboard admin
     */
    public function getAll()
    {
        return Module::with(['mentor', 'category'])
                     ->withCount('likes')
                     ->get();
    }
    
    public function getAllForLessons($request)
    {
        $query = Module::with(['mentor', 'category'])
                       ->withCount('likes');
    
        if ($request->search) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }
    
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
    
        return $query->latest()->get();
    }
        
    

    /**
     * Ambil modul milik mentor tertentu
     * Untuk dashboard mentor
     */
    public function getModulesByMentor(int $mentorId)
    {
        return Module::with(['category', 'submodules'])
                     ->withCount('likes')
                     ->where('mentor_id', $mentorId)
                     ->get();
    }


    /**
     * Simpan modul baru
     */
    public function createModule(array $data)
    {
        return Module::create($data);
    }

    /**
     * Update modul
     */
    public function update(Module $module, array $data)
    {
        $module->update($data);
        return $module;
    }

    /**
     * Hapus modul beserta submodules, likes, dan progress user
     */
    public function delete(Module $module)
    {
        // 1. Hapus thumbnail jika ada
        if ($module->thumbnail && \Storage::disk('public')->exists($module->thumbnail)) {
            \Storage::disk('public')->delete($module->thumbnail);
        }

        // 2. Hapus semua submodules beserta progress dan file
        foreach ($module->submodules as $sub) {

            // Hapus file konten submodule jika ada
            if ($sub->content_path && \Storage::disk('public')->exists($sub->content_path)) {
                \Storage::disk('public')->delete($sub->content_path);
            }
        
            // Hapus progress user terkait submodule ini
            if ($sub->progress()->exists()) { // pakai nama relasi progress
                $sub->progress()->delete();
            }
        
            // Hapus submodule
            $sub->delete();
        }
        

        // 3. Hapus likes terkait modul ini
        if ($module->likes()->exists()) {
            $module->likes()->delete();
        }

        // 4. Terakhir, hapus modul
        return $module->delete();
    }


    /**
     * Ambil modul beserta jumlah likes, optional bisa filter kategori
     */
    public function getModulesWithLikes($categoryId = null)
    {
        $query = Module::with(['mentor', 'category'])
                       ->withCount('likes');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }

    public function getById(int $id)
    {
        return Module::with(['user', 'category']) // ganti mentor → user
                     ->withCount('likes')
                     ->findOrFail($id);
    }
    
}
