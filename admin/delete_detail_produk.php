<?php
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_ids'])) {
    $ids_to_delete = implode(',', array_map('intval', $_POST['delete_ids']));

    $delete_order_items_query = "DELETE FROM order_items WHERE id_detail_barang IN ($ids_to_delete)";
    $delete_order_items_result = mysqli_query($con, $delete_order_items_query);

    if ($delete_order_items_result) {
        $delete_detail_barang_query = "DELETE FROM detail_barang WHERE id_detail_barang IN ($ids_to_delete)";
        $delete_detail_barang_result = mysqli_query($con, $delete_detail_barang_query);

        if ($delete_detail_barang_result) {
            header("Location: detail_produk.php?pesan=Produk berhasil dihapus");
        } else {
            header("Location: detail_produk.php?pesan=Produk gagal dihapus");
        }
    } else {
        header("Location: detail_produk.php?pesan=Gagal menghapus order items terkait");
    }
} else {
    header("Location: detail_produk.php?pesan=Tidak ada produk yang dipilih untuk dihapus");
}
?>
