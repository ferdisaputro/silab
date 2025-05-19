<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\LabItem;
use App\Models\ItemType;
use App\Models\LabItemDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UnitSeeder::class
        ]);

        ItemType::create([
            'item_type' => 'Alat',
        ]);
        ItemType::create([
            'item_type' => 'Bahan',
        ]);
        ItemType::create([
            'item_type' => 'Hasil Praktek',
        ]);

        $items = [
            ['item_name' => 'Kertas HVS A4 80Gr', 'item_code' => NULL, 'quantity' => 505, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2022-06-30 15:28:01', 'updated_at' => '2024-06-13 02:55:00'],
            ['item_name' => 'Kertas HVS A4 70Gr', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2022-07-02 04:35:02', 'updated_at' => '2024-03-07 02:30:31'],
            ['item_name' => 'Kertas HVS F4 70Gr', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2022-07-02 04:40:20', 'updated_at' => '2024-03-07 02:30:38'],
            ['item_name' => 'Kertas HVS F4 80Gr', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2022-07-02 04:54:16', 'updated_at' => '2024-03-07 02:30:59'],
            ['item_name' => 'Sticky Note 653 (39mm X 51mm)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:10:15', 'updated_at' => '2024-03-07 02:30:51'],
            ['item_name' => 'Sticky Note 654 (76mm X 77mm)', 'item_code' => NULL, 'quantity' => 12, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:11:06', 'updated_at' => '2024-06-13 02:39:29'],
            ['item_name' => 'Sticky Note 655 (77mm X 127mm)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:11:54', 'updated_at' => '2022-07-02 14:11:54'],
            ['item_name' => 'Sticky Note 656 (77mm X 51mm)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:12:49', 'updated_at' => '2022-10-03 23:36:11'],
            ['item_name' => 'Sticky Note 657 (77mm X 102mm)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:19:28', 'updated_at' => '2022-07-02 14:19:28'],
            ['item_name' => 'Snowman White Board BG (hitam)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:25:52', 'updated_at' => '2022-10-06 01:08:48'],
            ['item_name' => 'Snowman White Board BG (Biru)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:26:41', 'updated_at' => '2022-07-02 14:28:38'],
            ['item_name' => 'Snowman White Board BG (Hijau)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:29:45', 'updated_at' => '2022-07-02 14:30:16'],
            ['item_name' => 'Snowman White Board BG (Merah)', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:31:12', 'updated_at' => '2022-07-02 14:31:12'],
            ['item_name' => 'Kertas Manila Putih A1', 'item_code' => NULL, 'quantity' => 100, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 1, 'item_type_id' => 2, 'created_at' => '2022-07-02 14:36:09', 'updated_at' => '2024-06-13 06:01:55'],
            ['item_name' => 'PC - Asus All in one PC - A4310', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:08:41', 'updated_at' => '2022-10-10 02:13:45'],
            ['item_name' => 'Switch hub - Ubiquiti', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:10:02', 'updated_at' => '2022-09-22 10:46:22'],
            ['item_name' => 'Switch hub - D Link', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:14:36', 'updated_at' => '2022-09-13 15:54:24'],
            ['item_name' => 'Printer Laser Jet M125 A', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:15:41', 'updated_at' => '2022-09-28 07:37:54'],
            ['item_name' => 'Printer Epson L3150', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:16:11', 'updated_at' => '2022-10-07 06:58:25'],
            ['item_name' => 'Vacum Cleaner maximus 1000w', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:16:43', 'updated_at' => '2022-10-07 06:58:25'],
            ['item_name' => 'Barcode Scanner Argox AS-8000URB', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:18:11', 'updated_at' => '2022-09-13 15:54:19'],
            ['item_name' => 'Finger Print premier Series', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-28 07:20:11', 'updated_at' => '2022-10-07 06:58:25'],
            ['item_name' => 'Raspberry Pi 3b', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 91, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-29 20:06:18', 'updated_at' => '2022-10-12 09:20:56'],
            ['item_name' => 'Converter VGA to HDMI', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 91, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-08-29 20:10:39', 'updated_at' => '2024-03-07 02:34:45'],
            ['item_name' => 'Proyektor Dell Wide', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 91, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-09-14 18:21:17', 'updated_at' => '2022-10-07 06:54:28'],
            ['item_name' => 'Lampu Flip Flop', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'bagus', 'description' => NULL, 'user_id' => 91, 'unit_id' => 6, 'item_type_id' => 3, 'created_at' => '2022-09-14 19:06:04', 'updated_at' => '2022-09-18 17:25:37'],
            ['item_name' => 'Voting Dot', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 5, 'item_type_id' => 2, 'created_at' => '2022-10-04 01:57:56', 'updated_at' => '2022-10-04 01:58:26'],
            ['item_name' => 'masking Tape', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-04 03:26:46', 'updated_at' => '2022-10-04 03:26:59'],
            ['item_name' => 'Gunting', 'item_code' => NULL, 'quantity' => 0, 'specification' => '6 Inch', 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2022-10-04 03:31:06', 'updated_at' => '2022-10-04 12:17:18'],
            ['item_name' => 'AVO Meter Sanwa CD 800a', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-10-04 09:24:34', 'updated_at' => '2022-10-18 06:19:07'],
            ['item_name' => 'Kabel UTP CAT6', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 8, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:28:09', 'updated_at' => '2022-10-10 03:49:22'],
            ['item_name' => 'Kebel UTP CAT 5e', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 8, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:28:43', 'updated_at' => '2022-10-10 03:52:44'],
            ['item_name' => 'RJ45 CAT 5', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'CAT 5', 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:29:48', 'updated_at' => '2022-10-10 03:29:48'],
            ['item_name' => 'Fast Connector SC', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:30:45', 'updated_at' => '2022-10-10 03:30:55'],
            ['item_name' => 'Drop Core', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Meter', 'description' => NULL, 'user_id' => 96, 'unit_id' => 6, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:31:39', 'updated_at' => '2022-10-10 03:31:39'],
            ['item_name' => 'LAN TESTER', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2022-10-10 03:32:07', 'updated_at' => '2022-10-10 03:32:07'],
            ['item_name' => 'PCB POLOS 10x20', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 1, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:32:48', 'updated_at' => '2022-10-10 03:32:48'],
            ['item_name' => 'WeMos D1 Mini', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:33:21', 'updated_at' => '2022-10-10 03:33:21'],
            ['item_name' => 'Arduino UNO', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:33:48', 'updated_at' => '2022-10-10 03:33:48'],
            ['item_name' => 'Humidity Sensor', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:34:25', 'updated_at' => '2022-10-10 03:34:25'],
            ['item_name' => 'Range Finder', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:34:59', 'updated_at' => '2022-10-10 03:34:59'],
            ['item_name' => 'AVO Meter Analog', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:35:37', 'updated_at' => '2022-10-10 03:35:37'],
            ['item_name' => 'ESP8266-1', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:36:14', 'updated_at' => '2022-10-10 03:36:14'],
            ['item_name' => 'Node MCU v3', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 2, 'created_at' => '2022-10-10 03:37:00', 'updated_at' => '2022-10-10 03:37:00'],
            ['item_name' => 'Splacer', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Fusi splacer', 'description' => NULL, 'user_id' => 96, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2022-10-10 03:48:33', 'updated_at' => '2022-10-10 03:48:49'],
            ['item_name' => 'Monitor Dell B0-110', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-10-18 06:20:27', 'updated_at' => '2022-10-18 06:38:58'],
            ['item_name' => 'VGA to HDMI', 'item_code' => NULL, 'quantity' => 4, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-10-18 06:23:22', 'updated_at' => '2024-03-07 02:38:48'],
            ['item_name' => 'Kabel VGA 1 Meter', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-10-18 06:35:16', 'updated_at' => '2022-10-18 06:38:58'],
            ['item_name' => 'Kabel HDMI 1 Meter', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-10-18 06:36:52', 'updated_at' => '2024-03-07 02:34:38'],
            ['item_name' => 'Folio Bergaris', 'item_code' => NULL, 'quantity' => 143, 'specification' => NULL, 'description' => NULL, 'user_id' => 96, 'unit_id' => 5, 'item_type_id' => 2, 'created_at' => '2022-11-14 01:45:22', 'updated_at' => '2024-06-13 02:52:37'],
            ['item_name' => 'Modul Line Followers', 'item_code' => NULL, 'quantity' => 8, 'specification' => 'Modul praktikum mikrokontroller', 'description' => NULL, 'user_id' => 95, 'unit_id' => 6, 'item_type_id' => 3, 'created_at' => '2022-11-21 08:11:16', 'updated_at' => '2024-03-07 02:39:44'],
            ['item_name' => 'DS18B20 Temperature sensor', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'sensor suhu air', 'description' => NULL, 'user_id' => 98, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2022-11-22 07:05:18', 'updated_at' => '2022-11-22 07:05:18'],
            ['item_name' => 'LCD modul 2x16', 'item_code' => NULL, 'quantity' => 0, 'specification' => NULL, 'description' => NULL, 'user_id' => 98, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2022-11-22 07:05:44', 'updated_at' => '2022-11-22 07:05:44'],
            ['item_name' => 'PC Acer Verton borrow RSI', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Core i7\nRAM 16 GB\nSSD', 'description' => NULL, 'user_id' => 1, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2023-03-09 01:17:40', 'updated_at' => '2023-03-09 01:27:02'],
            ['item_name' => 'Kertas HVS A4 75Gr', 'item_code' => NULL, 'quantity' => 8500, 'specification' => NULL, 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2023-10-31 02:02:21', 'updated_at' => '2023-10-31 02:04:29'],
            ['item_name' => 'Komputer', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Dell', 'description' => NULL, 'user_id' => 100, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2024-03-14 01:49:30', 'updated_at' => '2024-03-14 01:49:30'],
            ['item_name' => 'Komputer Al In One', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Hp', 'description' => NULL, 'user_id' => 100, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2024-03-14 01:50:08', 'updated_at' => '2024-03-14 01:50:08'],
            ['item_name' => 'Soldering', 'item_code' => NULL, 'quantity' => 1, 'specification' => 'Okachi 40 W', 'description' => NULL, 'user_id' => 100, 'unit_id' => 7, 'item_type_id' => 1, 'created_at' => '2024-03-14 01:51:27', 'updated_at' => '2024-03-14 02:00:16'],
            ['item_name' => 'Desolderng ( Sedot Timah)', 'item_code' => NULL, 'quantity' => 4, 'specification' => 'Desoldering Pump', 'description' => NULL, 'user_id' => 100, 'unit_id' => 7, 'item_type_id' => 1, 'created_at' => '2024-03-14 01:57:10', 'updated_at' => '2024-03-14 01:57:42'],
            ['item_name' => 'Desoldering Pump ( Sedot Timah )', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'Denko DS -3', 'description' => NULL, 'user_id' => 100, 'unit_id' => 6, 'item_type_id' => 1, 'created_at' => '2024-03-14 01:59:41', 'updated_at' => '2024-03-14 01:59:41'],
            ['item_name' => 'Barcode Scanner', 'item_code' => NULL, 'quantity' => 0, 'specification' => '13', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:03:13', 'updated_at' => '2024-06-11 08:03:13'],
            ['item_name' => 'Barcode Scanner 2D', 'item_code' => NULL, 'quantity' => 1000, 'specification' => '13', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:04:37', 'updated_at' => '2024-06-13 02:49:51'],
            ['item_name' => 'barcode Scanner 1D', 'item_code' => NULL, 'quantity' => 5, 'specification' => '5', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:05:19', 'updated_at' => '2024-06-11 08:05:32'],
            ['item_name' => 'portable Printer Thermal', 'item_code' => NULL, 'quantity' => 18, 'specification' => '18', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:06:58', 'updated_at' => '2024-06-11 08:07:11'],
            ['item_name' => 'RFID Reader', 'item_code' => NULL, 'quantity' => 12, 'specification' => '12', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:07:41', 'updated_at' => '2024-06-13 02:45:09'],
            ['item_name' => 'RFID (Card)', 'item_code' => NULL, 'quantity' => 3, 'specification' => '3', 'description' => NULL, 'user_id' => 95, 'unit_id' => 4, 'item_type_id' => 1, 'created_at' => '2024-06-11 08:08:02', 'updated_at' => '2024-06-11 08:08:13'],
            ['item_name' => 'tv', 'item_code' => NULL, 'quantity' => 0, 'specification' => 'samsung', 'description' => NULL, 'user_id' => 1, 'unit_id' => 2, 'item_type_id' => 2, 'created_at' => '2024-06-13 08:29:01', 'updated_at' => '2024-06-13 08:29:01'],
        ];

        $createdItems = DB::table('items')->insert($items);

        // Item::factory(20)->create()->each(function($item) {
        //     $labItem = LabItem::factory()->create();
        // });

        LabItem::factory(10)->create();
    }
}
