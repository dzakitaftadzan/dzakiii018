<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- TAMBAHKAN BARIS INI
use App\Services\ItemService;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Controllers\Api\BaseController;
use Exception;

class ItemController extends BaseController {
    protected ItemService $svc;

    public function __construct(ItemService $svc) {
        $this->svc = $svc;
    }

    public function index(Request $request) {
        // Ambil semua data dari service, lalu filter jika ada category_id
        $items = $this->svc
            ->all()
            ->filter(fn($item) => 
                !$request->category_id || $item->category_id == $request->category_id
            );
            
        // Gunakan ->values() agar format array JSON tetap rapi
        return $this->success($items->values(), 'Berhasil mengambil data item beserta filternya');
    }

    public function store(StoreItemRequest $req) {
        $item = $this->svc->create($req->validated());
        return $this->success($item, "Item dibuat", 201);
    }

    public function show($id) {
        try {
            $item = $this->svc->find($id);
            return $this->success($item, 'Berhasil menarik satu data Item');
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function update(UpdateItemRequest $req, $id) {
        $item = $this->svc->update($id, $req->validated());
        return $this->success($item, "Item diperbarui");
    }

    public function destroy($id) {
        $this->svc->delete($id);
        return $this->success(null, "Item dihapus", 204);
    }
}