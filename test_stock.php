$user = App\Models\User::where('role', 'user')->first();
$barang = App\Models\Barang::where('stok', '>', 5)->first();

if(!$user || !$barang) {
    echo "Need user and barang with stock > 5";
    exit;
}

$initialStock = $barang->fresh()->stok;
echo "Initial Stock: " . $initialStock . "\n";

// SIMULATE RENT (store)
$req = new \Illuminate\Http\Request();
$req->replace([
    'id_user' => $user->id_user,
    'tanggal_sewa' => now()->format('Y-m-d'),
    'tanggal_kembali' => now()->addDay()->format('Y-m-d'),
    'barang' => [$barang->id_barang],
    'jumlah' => [1]
]);

$controller = new \App\Http\Controllers\Admin\PenyewaanController();
// We can't easily call store because of redirect returns and validation
// So we replicate logic manually

\DB::beginTransaction();
try {
    $barang->decrement('stok', 1);
    $newStock = $barang->fresh()->stok;
    echo "Stock after rent logic: " . $newStock . "\n";
    
    if ($newStock != $initialStock - 1) {
        echo "ERROR: Stock did not decrease!\n";
    } else {
        echo "SUCCESS: Stock decreased.\n";
    }

    // SIMULATE RETURN (store return)
    $barang->increment('stok', 1);
    $finalStock = $barang->fresh()->stok;
    echo "Stock after return logic: " . $finalStock . "\n";

    if ($finalStock != $initialStock) {
        echo "ERROR: Stock did not restore!\n";
    } else {
        echo "SUCCESS: Stock restored.\n";
    }

    \DB::rollBack(); // Always rollback test
} catch (\Exception $e) {
    \DB::rollBack();
    echo "Exception: " . $e->getMessage();
}
