@extends('layouts.admin')
@section('title', 'Settings')
@section('header_title', 'Master Settings')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <!-- Tabs Header -->
    <div class="px-6 border-b border-gray-100 bg-gray-50/50 flex gap-6 pt-4">
        <button type="button" onclick="switchTab('utama')" id="btn-utama" class="tab-btn text-brand-green border-b-2 border-brand-green font-medium pb-4 transition">Info Utama & Kontak</button>
        <button type="button" onclick="switchTab('beranda')" id="btn-beranda" class="tab-btn text-gray-500 hover:text-gray-700 pb-4 transition">Beranda (Hero)</button>
        <button type="button" onclick="switchTab('tentang')" id="btn-tentang" class="tab-btn text-gray-500 hover:text-gray-700 pb-4 transition">Tentang Kami</button>
    </div>
    
    <div class="p-6">
        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Tab Content: UTAMA -->
            <div id="tab-utama" class="tab-pane flex flex-col gap-6">
                <!-- WhatsApp Info -->
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-brands fa-whatsapp mt-1 mr-2"></i>Kontak Utama (Pemesanan)</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">WhatsApp Number 1 <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-brands fa-whatsapp text-gray-400"></i>
                            </div>
                            <input type="text" name="whatsapp_number" value="{{ \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? env('WHATSAPP_NUMBER', '6281234567890') }}" required class="w-full pl-10 px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <p class="text-xs text-gray-500 mt-1.5">Gunakan kode negara tanpa simbol + (misal: 6281234567890).</p>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">WhatsApp Number 2</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-brands fa-whatsapp text-gray-400"></i>
                            </div>
                            <input type="text" name="whatsapp_number_2" value="{{ \App\Models\Setting::where('key', 'whatsapp_number_2')->value('value') }}" class="w-full pl-10 px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ \App\Models\Setting::where('key', 'email')->value('value') ?? 'halo@faniaflowershop.com' }}" class="w-full pl-10 px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                    </div>
                </div>

                <!-- Gallery Settings -->
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-regular fa-images mt-1 mr-2"></i>Pengaturan Galeri</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Drive Link (Lihat Galeri Keseluruhan)</label>
                        <input type="url" name="google_drive_link" value="{{ \App\Models\Setting::where('key', 'google_drive_link')->value('value') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30" placeholder="https://drive.google.com/...">
                    </div>
                </div>

                <!-- Address Info -->
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-map-location-dot mt-1 mr-2"></i>Informasi Alamat & Peta</h3>
                    <div class="flex flex-col gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Lengkap</label>
                            <textarea name="company_address" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">{{ \App\Models\Setting::where('key', 'company_address')->value('value') ?? "Jl. Bunga Indah No. 10\nKebayoran Baru, Jakarta Selatan 12120" }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Label Lokasi Pintasan (Opsional)</label>
                            <input type="text" name="company_pin_label" value="{{ \App\Models\Setting::where('key', 'company_pin_label')->value('value') ?? 'Fania Flower Shop Studio' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Maps Embed Link / Iframe</label>
                            <textarea name="company_map_embed" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30" placeholder='<iframe src="https://www.google.com/maps/embed?...'>{{ \App\Models\Setting::where('key', 'company_map_embed')->value('value') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Sistem akan otomatis mendeteksi dari URL atau tag iframe keseluruhan.</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Socials -->
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-link mt-1 mr-2"></i>Tautan Sosial Media (Footer)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5"><i class="fa-brands fa-instagram"></i> Instagram URL</label>
                            <input type="text" name="social_instagram" value="{{ \App\Models\Setting::where('key', 'social_instagram')->value('value') ?? '#' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5"><i class="fa-brands fa-tiktok"></i> TikTok URL</label>
                            <input type="text" name="social_tiktok" value="{{ \App\Models\Setting::where('key', 'social_tiktok')->value('value') ?? '#' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5"><i class="fa-brands fa-whatsapp"></i> WhatsApp URL</label>
                            <input type="text" name="social_whatsapp" value="{{ \App\Models\Setting::where('key', 'social_whatsapp')->value('value') ?? '#' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5"><i class="fa-brands fa-facebook-f"></i> Facebook URL</label>
                            <input type="text" name="social_facebook" value="{{ \App\Models\Setting::where('key', 'social_facebook')->value('value') ?? '#' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: BERANDA -->
            <div id="tab-beranda" class="tab-pane hidden flex-col gap-6">
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-home mt-1 mr-2"></i>Tampilan Beranda (Hero Section)</h3>
                    <div class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Baris 1</label>
                                <input type="text" name="hero_title_1" value="{{ \App\Models\Setting::where('key', 'hero_title_1')->value('value') ?? 'Kirim Bunga,' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Baris 2 (Italic Cursive)</label>
                                <input type="text" name="hero_title_2" value="{{ \App\Models\Setting::where('key', 'hero_title_2')->value('value') ?? 'Sampaikan Perasaan' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat (Subtitle)</label>
                            <textarea name="hero_subtitle" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">{{ \App\Models\Setting::where('key', 'hero_subtitle')->value('value') ?? 'Buket segar pilihan untuk setiap momen spesial dalam hidup Anda.' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Hero Utama</label>
                            @php $heroImg = \App\Models\Setting::where('key', 'hero_image_path')->value('value'); @endphp
                            @if($heroImg)
                                <div class="mb-3 w-40 h-auto rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ Storage::url($heroImg) }}" class="w-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="hero_image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar hero.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: TENTANG KAMI -->
            <div id="tab-tentang" class="tab-pane hidden flex-col gap-6">
                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-address-card mt-1 mr-2"></i>Header Halaman "Tentang"</h3>
                    <div class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Utama Halaman</label>
                                <input type="text" name="about_title" value="{{ \App\Models\Setting::where('key', 'about_title')->value('value') ?? 'Tentang Fania Flower Shop' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Sub Judul</label>
                                <input type="text" name="about_subtitle" value="{{ \App\Models\Setting::where('key', 'about_subtitle')->value('value') ?? 'Kami merangkai cerita...' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm mt-4">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-book-open mt-1 mr-2"></i>Ringkasan Cerita Bunga</h3>
                    <div class="flex flex-col gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Cerita</label>
                            <input type="text" name="about_story_title" value="{{ \App\Models\Setting::where('key', 'about_story_title')->value('value') ?? 'Mekar dengan Cinta Sejak 2018' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Isi Cerita / Deskripsi (Panjang)</label>
                            <textarea name="about_story_content" rows="6" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">{{ \App\Models\Setting::where('key', 'about_story_content')->value('value') ?? "Berawal dari kecintaan kami..." }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto Sampul Samping</label>
                            @php $aboutImg = \App\Models\Setting::where('key', 'about_image_path')->value('value'); @endphp
                            @if($aboutImg)
                                <div class="mb-3 w-40 h-auto rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ Storage::url($aboutImg) }}" class="w-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="about_image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                    </div>
                </div>

                <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm mt-4">
                    <h3 class="text-brand-green font-medium font-serif border-b border-gray-100 pb-3 mb-4"><i class="fa-solid fa-chart-line mt-1 mr-2"></i>Statistik Kepercayaan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Statistik 1 - Angka (Mis. 5,000+)</label>
                            <input type="text" name="about_stat_1_value" value="{{ \App\Models\Setting::where('key', 'about_stat_1_value')->value('value') ?? '5,000+' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Statistik 1 - Label (Mis. Terkirim)</label>
                            <input type="text" name="about_stat_1_text" value="{{ \App\Models\Setting::where('key', 'about_stat_1_text')->value('value') ?? 'Buket Terkirim' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Statistik 2 - Angka (Mis. 100%)</label>
                            <input type="text" name="about_stat_2_value" value="{{ \App\Models\Setting::where('key', 'about_stat_2_value')->value('value') ?? '100%' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Statistik 2 - Label (Mis. Segar)</label>
                            <input type="text" name="about_stat_2_text" value="{{ \App\Models\Setting::where('key', 'about_stat_2_text')->value('value') ?? 'Kesegaran Terjamin' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:border-brand-pink transition block bg-gray-50/30">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Submit -->
            <div class="border-t border-gray-100 pt-6 mt-6 pb-2">
                <button type="submit" class="w-full md:w-auto bg-brand-green text-white px-8 py-3 rounded-xl shadow font-medium hover:bg-opacity-90 hover:shadow-lg transition">
                    Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tabId) {
        // Hide all frames
        document.querySelectorAll('.tab-pane').forEach((el) => {
            el.classList.add('hidden');
            el.classList.remove('flex');
        });
        
        // Show target frame
        const target = document.getElementById('tab-' + tabId);
        target.classList.remove('hidden');
        target.classList.add('flex');

        // Reset styling for all buttons
        document.querySelectorAll('.tab-btn').forEach((btn) => {
            btn.classList.remove('text-brand-green', 'border-b-2', 'border-brand-green', 'font-medium');
            btn.classList.add('text-gray-500');
        });

        // Set styling for active button
        const activeBtn = document.getElementById('btn-' + tabId);
        activeBtn.classList.remove('text-gray-500');
        activeBtn.classList.add('text-brand-green', 'border-b-2', 'border-brand-green', 'font-medium');
    }
</script>
@endsection
