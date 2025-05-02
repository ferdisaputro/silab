<?php

namespace Database\Seeders;

use Illuminate;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::truncate();
        // Staff::truncate();

        // DB::table('users')->delete();
        // DB::table('staff')->delete();

        $employee = [
            ['code' => '198911092013041001', 'name' => 'Novianto Hadi Raharjo', 'email' => 'novianto_hadi@polije.ac.id', 'phone' => '08980403048', 'photo' => 'h71ppH5t20221006142152.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Alwan Abdurahman', 'email' => 'alwan_abdurahman@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Luluk Cahyo Wiyono', 'email' => 'luluk_cahyo_wiyono@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198807022019031010', 'name' => 'Husin', 'email' => 'husin@gmail.com', 'phone' => NULL, 'photo' => '6X4lNfWs20210719021041.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Intan Sulistyaningrum Sakkinah', 'email' => 'intan_sulistyaningrum_sakkinah@gmail.com', 'phone' => NULL, 'photo' => '5QYqMiAn20210719022755.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198106152006041002', 'name' => 'Syamsul Arifin', 'email' => 'syamsul_arifin@polije.ac.id', 'phone' => NULL, 'photo' => '2uNfVhzW20210719020707.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '197709292005011003', 'name' => 'Didit Rahmat Hartadi', 'email' => 'didit_rahmat_hartadi@gmail.com', 'phone' => NULL, 'photo' => 'EfHffpHt20210719020908.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Nanik Anita Mukhlisoh', 'email' => 'nanik_anita_mukhlisoh@gmail.com', 'phone' => NULL, 'photo' => 'vymahzc120210719022733.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198302032006041003', 'name' => 'Hendra Yufit Riskiawan', 'email' => 'hendrayufit@polije.ac.id', 'phone' => NULL, 'photo' => 'VXCUZWhW20210719015928.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Mukhamad Angga Gumilang', 'email' => 'mukhamad_angga_gumilang@gmail.com', 'phone' => NULL, 'photo' => 'Sb8Nbt8a20210719022608.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '197808192005012001', 'name' => 'Ika Widiastuti', 'email' => 'ika_widiastuti@gmail.com', 'phone' => NULL, 'photo' => 'XxeK4Hav20210719020736.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ratih Ayuninghemi', 'email' => 'ratih_ayuninghemi@gmail.com', 'phone' => NULL, 'photo' => 'ZfQZ5M4820210719022145.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '197306172018051001', 'name' => 'Ely Mulyadi', 'email' => 'ely_mulyadi@gmail.com', 'phone' => NULL, 'photo' => 'GYQz2NuO20210719020503.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Bakhtiyar Hadi Prakoso', 'email' => 'bakhtiyar_hadi_prakoso@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Choirul Huda', 'email' => 'choirul_huda@gmail.com', 'phone' => NULL, 'photo' => 'IJvQnjri20210719023112.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Surateno', 'email' => 'surateno@gmail.com', 'phone' => NULL, 'photo' => 'm4TKxLtG20210719021217.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Dia Bitari Mei Yuana', 'email' => 'dia_bitari@polije.ac.id', 'phone' => NULL, 'photo' => 'VDTugQk720210719023028.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '199104292019031011', 'name' => 'Faisal Lutfi Afriansyah', 'email' => 'faisal_lutfi@polije.ac.id', 'phone' => NULL, 'photo' => 'SYjG2pTW20210719020527.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198903292019031007', 'name' => 'Taufiq Rizaldi', 'email' => 'taufiq_rizaldi@polije.ac.id', 'phone' => NULL, 'photo' => 'zGPsamBP20210719021026.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Arvita Agus Kurniasari', 'email' => 'arvita_agus@polije.ac.id', 'phone' => NULL, 'photo' => 'hCHgy6Dh20210719022825.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'I GEDE WIRYAWAN', 'email' => 'i_gede_wiryawan@polije.ac.id', 'phone' => NULL, 'photo' => 'tDxdJtKQ20210719022526.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198804042020122013', 'name' => 'Pramuditha Shinta Dewi Puspitasari', 'email' => 'pramuditha_shinta@polije.ac.id', 'phone' => NULL, 'photo' => '6y2CYu2220210719021145.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'MUHAMMAD YUNUS', 'email' => 'muhammad_yunus@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198005172008121002', 'name' => 'Dwi Putro Sarwo Setyohadi', 'email' => 'dwi_putro@polije.ac.id', 'phone' => NULL, 'photo' => '0vjWJlXw20210719020840.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '198301092018031001', 'name' => 'Hermawan Arief P', 'email' => 'hermawan_arief@polije.ac.id', 'phone' => NULL, 'photo' => 'KbcHjmwC20210719021010.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Lukie Perdanasari', 'email' => 'lukie_perdanasari@polije.ac.id', 'phone' => NULL, 'photo' => 'Jl076awv20210719022810.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '197104082001121003', 'name' => 'Wahyu Kurnia Dewanto', 'email' => 'wahyu_kurnia@polije.ac.id', 'phone' => NULL, 'photo' => 'DpyoRB2420210719015831.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Moch.Munih Dian W', 'email' => 'moch.munih_dian@polije.ac.id', 'phone' => NULL, 'photo' => '0dqNAJRW20210719022021.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Agus Hariyanto', 'email' => 'agus_hariyanto@polije.ac.id', 'phone' => NULL, 'photo' => 'qP7YKjSi20210719021239.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Denny Wijanarko', 'email' => 'denny_wijanarko@polije.ac.id', 'phone' => NULL, 'photo' => 'dnEkUU9720210719021455.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '19700929 200312 1 001', 'name' => 'Yogiswara', 'email' => 'yogiswara@polije.ac.id', 'phone' => NULL, 'photo' => 'nRl44FyN20210719021533.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Bekti Maryuni Susanto', 'email' => 'bekti_maryuni@polije.ac.id', 'phone' => NULL, 'photo' => 'w1Nq6Ya520210719021651.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Putri Santika', 'email' => 'putri_santika@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '19780816 200501 1 002', 'name' => 'Beni Widiawan', 'email' => 'beni_widiawan@polije.ac.id', 'phone' => NULL, 'photo' => '6WAZDznS20210719021513.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Agus Purwadi', 'email' => 'agus_purwadi@polije.ac.id', 'phone' => NULL, 'photo' => 'URbuiSJV20210719021635.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Syamsiar Kautsar', 'email' => 'syamsiar_kautsar@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Victor Phoa', 'email' => 'victor_phoa@polije.ac.id', 'phone' => NULL, 'photo' => 'nr8U8ECG20210719021710.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '19701128 200312 1 001', 'name' => 'Hariyono Rakhmad', 'email' => 'hariyono_rakhmad@polije.ac.id', 'phone' => NULL, 'photo' => 'KoE5Iss120210719021437.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Shabrina Choirunnisa', 'email' => 'shabrina_choirunnisa@polije.ac.id', 'phone' => NULL, 'photo' => 'RnC0rUjh20210719022850.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Lalitya Nindita Sahenda', 'email' => 'lalitya_nindita@polije.ac.id', 'phone' => NULL, 'photo' => 'BFmdWXv320210719021732.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Zainul Hakim', 'email' => 'zainul_hakim@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'R. Agus Sariono', 'email' => 'r_agus_sariono@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'GULLIT TORNADO TAUFAN', 'email' => 'gullit_tornado@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ghanesya Hari Murti', 'email' => 'ghanesya_hari@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Adi Heru Utomo', 'email' => 'adi_heru@polije.ac.id', 'phone' => NULL, 'photo' => 'HhuNd4Dy20210719021939.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Zilvanhisna Emka Fitri', 'email' => 'zilvanhisna_emka@polije.ac.id', 'phone' => NULL, 'photo' => 'cahHS1ga20210719022433.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Aji Seto Arifianto', 'email' => 'aji_seto@polije.ac.id', 'phone' => NULL, 'photo' => 'zuIxbsSU20210719020311.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Denny Trias Utomo', 'email' => 'denny_trias@polije.ac.id', 'phone' => NULL, 'photo' => 'Dw5ZaVgM20210719023006.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Prawidya Destarianto', 'email' => 'prawidya_destarianto@polije.ac.id', 'phone' => NULL, 'photo' => 'tKHS4dSD20210719021955.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '19920528 201803 2 001', 'name' => 'Bety Etikasari', 'email' => 'bety_etikasari@polije.ac.id', 'phone' => NULL, 'photo' => 'qNjtb0SF20210711071927.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Nugroho Setyo Wibowo', 'email' => 'nugroho_setyo@polije.ac.id', 'phone' => NULL, 'photo' => 'Yq9qF6nt20210719021918.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Lukman Hakim', 'email' => 'lukman_hakim@polije.ac.id', 'phone' => NULL, 'photo' => 'WF9MWFbX20210719023055.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Rizki Febrian Pramudita', 'email' => 'rizki_febrian@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Elly Antika', 'email' => 'elly_antika@polije.ac.id', 'phone' => NULL, 'photo' => 'uG8sXp3w20210719022201.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Mudafiq Riyan Pratama', 'email' => 'mudafiq_riyan@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ery Setiyawan Jullev Atmaji', 'email' => 'ery_setiyawan@polije.ac.id', 'phone' => NULL, 'photo' => 'Dc5jVTi420210719022456.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => '19911211 201803 1 001', 'name' => 'Khafidurrohman Agustianto', 'email' => 'khafidurrohman_agustianto@polije.ac.id', 'phone' => NULL, 'photo' => 'yW1kJsNR20210719022355.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Trismayanti Dwi Puspitasari', 'email' => 'trismayanti_dwi@polije.ac.id', 'phone' => NULL, 'photo' => 'wibnrr1c20210719022416.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Andri Permana Wicaksono', 'email' => 'andri_permana@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Jumiatun', 'email' => 'jumiatun@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'I Putu Dody Lesmana', 'email' => 'dody@polije.ac.id', 'phone' => NULL, 'photo' => 'GiuND4QQ20210719022226.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Adriadi Novawan', 'email' => 'adriadi_novawan@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ahmad Basri Saifur Rahman', 'email' => 'ahmad_basri@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Degita Danur Suharsono', 'email' => 'degita_danur@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Alfi Hidayatu Miqawati', 'email' => 'alfi_hidayatu@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Renata Kenanga Rinda', 'email' => 'renata_kenanga@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Enik Rukiati', 'email' => 'enik_rukiati@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Vigo Dewangga', 'email' => 'vigo_dewangga@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Geri Barnas Saputra', 'email' => 'geri_barnas@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Sunoko Setyawan', 'email' => 'sunoko_setyawan@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Estin Roso Pristiwaningsih', 'email' => 'estin_roso@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Rhama Wisnu Wardhana', 'email' => 'rhama_wisnu@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Dyah Aju Hermawati', 'email' => 'dyah_ajuh@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ruqoyah Yulia Hasanah Dhomiri', 'email' => 'ruqoyah_yuliah@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Adi Sucipto', 'email' => 'adi_sucipto@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Sholihah Ayu Wulandari', 'email' => 'sholihah_ayuw@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ikrima Halimatus Sa\'diyah', 'email' => 'ikrima_halimatuss@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Suwardi LB', 'email' => 'suwardilb@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Wajihudin', 'email' => 'wajihudin@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Suyik Binarkaheni', 'email' => 'suyik_binarkaheni@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Mochammad Rifki Ulil Albaab', 'email' => 'mrifki_ulil_albaab@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Suparto (Kampus Bondowoso)', 'email' => 'suparto_bws@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Suyitno', 'email' => 'suyitno@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Asmunir', 'email' => 'asmunir@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Asep Samsudin', 'email' => 'asep_samsudin@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Ratri Handayani', 'email' => 'ratri_handayani@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Moch. Rif\'an Eko Utomo', 'email' => 'rifan@polije.ac.id', 'phone' => '089657422001', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Yunita Dwi P', 'email' => 'yunita@polije.ac.id', 'phone' => NULL, 'photo' => 'sGu1tPGf20220819090724.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Egy', 'email' => 'egy@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Muhammad Hafidh Firmansyah', 'email' => 'hafid_firmansyah@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 1],
            ['code' => NULL, 'name' => 'Yeni Arista Herdina Safitri', 'email' => 'yeni_arista@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 0, 'staff_status_id' => 3],
            ['code' => '199007062022032007', 'name' => 'Ariyana', 'email' => 'ariyana@polije.ac.id', 'phone' => '085233003162', 'photo' => 'bEWP9daz20221023062950.jpg', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => '199104132015101001', 'name' => 'Appredo Probo Anugro', 'email' => 'appredo@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Cahyana Ahmad Pahlevi', 'email' => 'cahyanapahlevi@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 0, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Teguh Erliyan', 'email' => 'teguh-e@polije.ac.id', 'phone' => '081292926460', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => 'T19880109201709201', 'name' => 'Istik Lailiah S.Kom', 'email' => 'istik@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 2],
            ['code' => 'T19890122201709101', 'name' => 'Muhammad Syafiq S.Kom', 'email' => 'msyafiq@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 2],
            ['code' => 'T19911018201504101', 'name' => 'Wahyu Dwi Permadi', 'email' => 'wahyu_dp@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => '199606092022031008', 'name' => 'Riyadlus Sholihin', 'email' => 'riyadlus_sholihin@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Raihana Ariba Nurlaili', 'email' => 'rere_jti@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => '197612072008121001', 'name' => 'Agus Santoso', 'email' => 'agus_san@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => 'T19900702201603101', 'name' => 'David Juli Ariyadi', 'email' => 'david_juli@polije.ac.id', 'phone' => '085258605369', 'photo' => '8ZqUlvGk20240314075639.png', 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Ratna Dwi Kristina Sari', 'email' => 'ratna_dks@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Fitria \'Aziati', 'email' => 'fitriaaziati999@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Daniel Pugoh Wicaksono', 'email' => 'daniel_pw@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Riska Virliana Maharanti', 'email' => 'riskavmh@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Evan Hendra Lukito', 'email' => 'evan_hl@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Fajriansyah Decky Setiawan', 'email' => 'fajriansyah_ds@gmail.com', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Achmad Dinofaldi Firmansyah', 'email' => 'bangik@polije.ac.id', 'phone' => '081252367128', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Bunga Prasetya Dwi Ulul Azmi', 'email' => 'bunga@polije.ac.id', 'phone' => '083111693588', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Iphang Rere Admaja', 'email' => 'iphang@polije.ac.id', 'phone' => '083111529303', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Shinta Destira Ayu', 'email' => 'shinta_destira@polije.ac.id', 'phone' => '085335102750', 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Yudi Sanjaya', 'email' => 'yudi_sanjaya@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Rahadian Teguh Nugroho', 'email' => 'rahadian_teguh@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Wahyu Putra Tri Mariono', 'email' => 'wahyu_putra@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Zayd Al Munshif', 'email' => 'zayd@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],
            ['code' => NULL, 'name' => 'Achmad Syaifulloh', 'email' => 'ach_syaifulloh@polije.ac.id', 'phone' => NULL, 'photo' => NULL, 'password' => '$2y$10$R4xtO4NyFkoYOYrM0KNv9eElWruz9MxFbt1kv0JSsXfCxSWVDTb1q', 'status' => 1, 'staff_status_id' => 3],

        ];

        foreach ($employee as $index => $data) {
            $user = new User;
            $user->code = $data['code'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->photo = $data['photo'];
            $user->password = $data['password'];
            $user->save();

            $staff = new Staff;

            $staff->user_id = $user->id;
            $staff->staff_status_id = $data['staff_status_id'];
            $staff->status = $data['status'];
            $staff->save();
        }

        $defaultUser = User::create([
            'name' => 'Admin',
            'code' => Str::random(4),
            'phone' => fake()->phoneNumber, // Optional, can be null
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        Staff::create([
            'user_id' => $defaultUser->id,
            'status' => 1,
            'staff_status_id' => 1,
        ]);
        $teknisi = User::create([
            'name' => 'Teknisi',
            'code' => Str::random(4),
            'phone' => fake()->phoneNumber, // Optional, can be null
            'email' => 'teknisi@gmail.com',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        Staff::create([
            'user_id' => $teknisi->id,
            'status' => 1,
            'staff_status_id' => 3,
        ]);

        $defaultUser->assignRole(Role::find(1));
        $teknisi->assignRole(Role::find(1));

        // User::factory(20)->create()->each(function($user) {
        //     Staff::factory(1)->create([
        //         'user_id' => $user->id
        //     ]);
        // });
    }
}
