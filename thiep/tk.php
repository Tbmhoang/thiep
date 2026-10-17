<?php
require_once 'db.php';

// Fetch RSVP report data if connected
$total_opens = 1248;
$attending_guests = 312;
$wishes_count = 189;

if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM rsvps");
        $row = $stmt->fetch();
        if ($row && $row['count'] > 0) {
            $attending_guests = intval($row['count']);
        }
    } catch (Exception $e) {}
}

$initial_style = $_GET['style'] ?? 'royal';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Thiết Kế Thiệp Mời - Tinh Khôi Wedding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Include html2canvas and jsPDF for PDF and PNG exports -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="tk.css">
</head>
<body class="bg-[#FAF8F5] text-[#2D2A26] font-['Plus_Jakarta_Sans'] antialiased">

    <!-- Header Navigation -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-[#E8E2D9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
            <a href="tc.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#C5A880]/20 border border-[#C5A880] flex items-center justify-center text-[#9A7B4F] font-serif font-bold text-lg">TM</div>
                <div class="flex flex-col">
                    <span class="font-serif font-bold text-lg tracking-wider text-[#2D2A26] group-hover:text-[#9A7B4F] transition-colors">STUDIO THIẾT KẾ</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-[#9A7B4F]">Thiệp Mời Cao Cấp</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-8 font-medium text-xs uppercase tracking-[0.18em]">
                <a href="tc.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Trang Chủ & Mẫu Thiệp</a>
                <a href="tk.php" class="text-[#9A7B4F] border-b-2 border-[#9A7B4F] pb-1 font-semibold">Studio Thiết Kế</a>
                <a href="ht.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Trung Tâm Hỗ Trợ</a>
            </nav>

            <div class="flex items-center gap-3">
                <button onclick="exportPDF()" class="px-4 py-2.5 bg-[#FAF8F5] border border-[#C5A880] text-[#9A7B4F] hover:bg-[#C5A880] hover:text-white transition-all text-xs font-semibold uppercase tracking-wider rounded flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span> Tải File PDF
                </button>
                <button onclick="exportPNG()" class="px-4 py-2.5 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.16em] font-semibold rounded transition-all flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-sm">image</span> Tải Ảnh PNG
                </button>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-20 max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Studio Workspace Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Customization Form (5 cols) -->
            <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-[#E8E2D9] shadow-md space-y-6">
                <div class="pb-4 border-b border-[#E8E2D9]">
                    <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-bold block mb-1">Bảng Soạn Thảo</span>
                    <h2 class="font-serif text-2xl font-bold text-[#2D2A26]">Tùy Chỉnh Nội Dung Thiệp</h2>
                </div>

                <!-- Style Selection Dropdown -->
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1.5 font-bold">1. Chọn Phong Cách Thiệp</label>
                    <select id="select-style" onchange="changeStyle(this.value)" class="w-full px-3 py-2.5 rounded-lg bg-[#FAF8F5] border border-[#C5A880] text-sm font-semibold text-[#2D2A26] focus:outline-none focus:ring-2 focus:ring-[#9A7B4F]">
                        <option value="royal" <?= $initial_style === 'royal' ? 'selected' : '' ?>>1. Cổ Điển Hoàng Gia (Château Royale)</option>
                        <option value="minimal" <?= $initial_style === 'minimal' ? 'selected' : '' ?>>2. Tối Giản Bắc Âu (Nordic Minimalist)</option>
                        <option value="botanical" <?= $initial_style === 'botanical' ? 'selected' : '' ?>>3. Vườn Địa Đàng (Botanical Garden)</option>
                        <option value="nocturne" <?= $initial_style === 'nocturne' ? 'selected' : '' ?>>4. Hiện Đại Sang Trọng (Nocturne Black Tie)</option>
                    </select>
                </div>

                <!-- Groom & Bride Info -->
                <div class="space-y-3 p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">2. Thông Tin Cô Dâu & Chú Rể</span>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Tên Chú Rể</label>
                        <input type="text" id="in-groom" value="Vũ Hoàng Nam" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Thông Tin Nhà Trai</label>
                        <input type="text" id="in-groom-parents" value="Trưởng nam của ông Vũ Đăng Khoa & bà Lê Thị Mai" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Tên Cô Dâu</label>
                        <input type="text" id="in-bride" value="Trần Mai Linh" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Thông Tin Nhà Gái</label>
                        <input type="text" id="in-bride-parents" value="Ái nữ của ông Trần Quang Hùng & bà Nguyễn Kim Oanh" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                </div>

                <!-- Date & Time Info -->
                <div class="space-y-3 p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">3. Thời Gian & Địa Điểm</span>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Ngày Hôn Lễ</label>
                            <input type="date" id="in-date" value="2025-11-28" onchange="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                        <div>
                            <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Giờ Khai Tiệc</label>
                            <input type="time" id="in-time" value="17:30" onchange="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Ngày Âm Lịch</label>
                        <input type="text" id="in-lunar" value="Nhằm Ngày 09 Tháng 10 Năm Ất Tỵ" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Tên Trung Tâm / Địa Điểm</label>
                        <input type="text" id="in-venue-name" value="Le Grand Ballroom - Park Hyatt Saigon" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-[#6E675F] mb-1">Địa Chỉ Chi Tiết</label>
                        <input type="text" id="in-venue-address" value="Số 2 Công Trường Lam Sơn, Bến Nghé, Quận 1, TP. Hồ Chí Minh" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                    </div>
                </div>

                <!-- Image Selection / Upload -->
                <div class="space-y-3 p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">4. Chèn Ảnh Vào Thiệp</span>
                    <p class="text-xs text-gray-500 italic">Chọn ảnh mẫu có sẵn hoặc tải ảnh mới từ máy tính để hiển thị trên thiệp.</p>
                    <div class="grid grid-cols-4 gap-2">
                        <img src="img/1.png" onclick="selectPresetImage('img/1.png')" class="w-full h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-[#9A7B4F] transition-all">
                        <img src="img/2.png" onclick="selectPresetImage('img/2.png')" class="w-full h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-[#9A7B4F] transition-all">
                        <img src="img/3.png" onclick="selectPresetImage('img/3.png')" class="w-full h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-[#9A7B4F] transition-all">
                        <img src="img/4.png" onclick="selectPresetImage('img/4.png')" class="w-full h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-[#9A7B4F] transition-all">
                    </div>
                    <div class="pt-2">
                        <input type="file" id="file-photo" accept="image/*" onchange="uploadUserPhoto(this)" class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#9A7B4F] file:text-white hover:file:bg-[#83633C] cursor-pointer">
                    </div>
                </div>

                <!-- Quote / Wording -->
                <div class="space-y-3 p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">5. Lời Mời & Lời Chúc</span>
                    <textarea id="in-quote" rows="3" oninput="syncPreview()" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F] resize-none">Sự hiện diện đầy yêu thương và những lời chúc phúc của quý khách là niềm vinh hạnh to lớn cho gia đình hai bên chúng tôi trong ngày khởi đầu chương mới hạnh phúc.</textarea>
                </div>
            </div>

            <!-- Right Column: Live Preview Frame (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white p-4 rounded-2xl border border-[#E8E2D9] shadow-md flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-[#2D2A26]">Khung Xem Trước Trực Quan Live</span>
                    </div>
                    <span class="text-xs text-[#9A7B4F] font-semibold italic">Đồng bộ tự động 100%</span>
                </div>

                <!-- Interactive Live Canvas Wrapper -->
                <div id="preview-container" class="w-full bg-[#FAF6F0] p-6 sm:p-10 rounded-2xl border-4 border-[#D4AF37] shadow-2xl transition-all duration-300">
                    <!-- Target element for export -->
                    <div id="live-card" class="space-y-6 text-center">
                        <div class="border-b border-[#C5A880]/40 pb-4">
                            <span id="card-parents-groom" class="text-xs text-gray-500 block italic">Trưởng nam của ông Vũ Đăng Khoa & bà Lê Thị Mai</span>
                            <span id="card-parents-bride" class="text-xs text-gray-500 block italic mt-0.5">Ái nữ của ông Trần Quang Hùng & bà Nguyễn Kim Oanh</span>
                        </div>

                        <div class="space-y-2">
                            <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-semibold block">Trân Trọng Kính Mời Quan Khách Dự Lễ Hôn Lễ</span>
                            <h2 id="card-couple-name" class="font-serif text-3xl sm:text-4xl font-bold text-[#2D2A26]">Vũ Hoàng Nam & Trần Mai Linh</h2>
                        </div>

                        <!-- Main Invitation Photo Frame -->
                        <div class="w-full aspect-[16/9] rounded-xl overflow-hidden border-2 border-[#C5A880] shadow-md my-4">
                            <img id="card-photo" src="img/1.png" alt="Ảnh thiệp cưới" class="w-full h-full object-cover">
                        </div>

                        <div class="p-4 bg-white/80 rounded-xl border border-[#C5A880]/30 max-w-lg mx-auto">
                            <p id="card-quote" class="text-sm text-gray-700 italic leading-relaxed">
                                Sự hiện diện đầy yêu thương và những lời chúc phúc của quý khách là niềm vinh hạnh to lớn cho gia đình hai bên chúng tôi trong ngày khởi đầu chương mới hạnh phúc.
                            </p>
                        </div>

                        <!-- Date & Time Box -->
                        <div class="p-4 bg-white/90 rounded-xl border border-[#C5A880]/40 max-w-lg mx-auto space-y-1">
                            <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">Thời Gian Diễn Ra</span>
                            <p id="card-time-date" class="font-serif font-bold text-xl text-[#2D2A26]">17:30 • Thứ Bảy, 28/11/2025</p>
                            <p id="card-lunar" class="text-xs text-gray-500 italic">Nhằm Ngày 09 Tháng 10 Năm Ất Tỵ</p>
                        </div>

                        <!-- Venue Box -->
                        <div class="p-4 bg-white/90 rounded-xl border border-[#C5A880]/40 max-w-lg mx-auto space-y-1 text-left">
                            <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block text-center">Địa Điểm Tổ Chức Tiệc</span>
                            <p id="card-venue-name" class="font-serif font-bold text-base text-[#2D2A26] text-center">Le Grand Ballroom - Park Hyatt Saigon</p>
                            <p id="card-venue-address" class="text-xs text-gray-600 text-center">Số 2 Công Trường Lam Sơn, Bến Nghé, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>

                <!-- DEDICATED SECTION: Xuất Bản Mẫu Thiệp & Lan Tỏa Hạnh Phúc -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-[#E8E2D9] shadow-md space-y-6">
                    <div class="pb-4 border-b border-[#E8E2D9] text-center">
                        <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-bold block mb-1">Cổng Phát Hành Trực Tuyến</span>
                        <h3 class="font-serif text-2xl font-bold text-[#2D2A26]">Xuất Bản Mẫu Thiệp & Lan Tỏa Hạnh Phúc</h3>
                        <p class="text-xs text-[#6E675F] mt-1 italic">Tự động tạo đường link chia sẻ thiệp riêng và xuất file PDF/PNG in ấn sắc nét.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Channel 1: Website thiệp riêng -->
                        <div class="p-5 rounded-xl bg-[#FAF8F5] border border-[#C5A880]/40 space-y-3">
                            <div class="flex items-center gap-2 text-[#9A7B4F]">
                                <span class="material-symbols-outlined text-xl">language</span>
                                <span class="text-xs uppercase tracking-wider font-bold">1. Website Thiệp Riêng</span>
                            </div>
                            <p class="text-xs text-gray-600">Đường link duy nhất chứa giao diện hình ảnh thiệp mời đã thiết kế ở trên.</p>
                            <div class="flex items-center gap-2">
                                <input type="text" id="share-link-input" readonly value="https://tinhkhoiwedding.vn/tk.php?id=1" class="w-full px-3 py-2 rounded bg-white border border-[#E8E2D9] text-xs font-mono select-all">
                                <button onclick="copyShareLink()" class="px-3 py-2 bg-[#9A7B4F] text-white text-xs uppercase font-bold rounded hover:bg-[#83633C] transition-colors shrink-0">
                                    Sao Chép
                                </button>
                            </div>
                            <button onclick="openStandaloneWebInvitation()" class="w-full py-2.5 bg-white border border-[#9A7B4F] text-[#9A7B4F] hover:bg-[#9A7B4F] hover:text-white transition-all text-xs font-bold uppercase tracking-wider rounded shadow-sm flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-base">open_in_new</span> Mở Màn Hình Thiệp Riêng
                            </button>
                        </div>

                        <!-- Channel 2: In ấn & lưu trữ kỷ niệm -->
                        <div class="p-5 rounded-xl bg-[#FAF8F5] border border-[#C5A880]/40 space-y-3">
                            <div class="flex items-center gap-2 text-[#9A7B4F]">
                                <span class="material-symbols-outlined text-xl">print</span>
                                <span class="text-xs uppercase tracking-wider font-bold">2. In Ấn & Lưu Trữ Kỷ Niệm</span>
                            </div>
                            <p class="text-xs text-gray-600">Xuất file chất lượng cao để mang ra xưởng in hoặc lưu giữ khoảnh khắc vĩnh viễn.</p>
                            <div class="space-y-2">
                                <button onclick="exportPDF()" class="w-full py-2.5 bg-[#FAF8F5] hover:bg-white border border-[#9A7B4F] text-[#9A7B4F] text-xs uppercase font-bold rounded transition-colors flex items-center justify-center gap-2 shadow-sm">
                                    <span class="material-symbols-outlined text-base">picture_as_pdf</span> Xuất File PDF In Ấn (300 DPI)
                                </button>
                                <button onclick="exportPNG()" class="w-full py-2.5 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase font-bold rounded transition-colors flex items-center justify-center gap-2 shadow-sm">
                                    <span class="material-symbols-outlined text-base">image</span> Xuất File Ảnh PNG Sắc Nét HD
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Báo cáo sơ bộ khách mời & phản hồi (RSVP) -->
                <div class="bg-white p-6 rounded-2xl border border-[#E8E2D9] shadow-md space-y-4">
                    <div class="flex items-center justify-between border-b border-[#E8E2D9] pb-3">
                        <div>
                            <h4 class="font-serif font-bold text-lg text-[#2D2A26]">Báo Cáo Sơ Bộ Khách Mời & Phản Hồi</h4>
                            <p class="text-xs text-gray-500">Thống kê lượt tương tác và số lượng khách xác nhận tham dự tiệc</p>
                        </div>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-[10px] uppercase font-bold tracking-wider rounded-full">Trực Tiếp</span>
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="p-3 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                            <span class="text-[11px] uppercase tracking-wider text-gray-500 block">Lượt Mở Thiệp</span>
                            <span class="font-serif font-bold text-2xl text-[#9A7B4F]"><?= $total_opens ?></span>
                        </div>
                        <div class="p-3 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                            <span class="text-[11px] uppercase tracking-wider text-gray-500 block">Khách Tham Dự</span>
                            <span class="font-serif font-bold text-2xl text-[#9A7B4F]"><?= $attending_guests ?></span>
                        </div>
                        <div class="p-3 bg-[#FAF8F5] rounded-xl border border-[#E8E2D9]">
                            <span class="text-[11px] uppercase tracking-wider text-gray-500 block">Lời Chúc Phúc</span>
                            <span class="font-serif font-bold text-2xl text-[#9A7B4F]"><?= $wishes_count ?></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- Standalone Fullscreen Invitation Modal -->
    <div id="standalone-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl p-6 sm:p-10 relative my-8">
            <button onclick="closeStandaloneModal()" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/10 hover:bg-black/20 text-[#2D2A26] flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div id="standalone-content">
                <!-- Dynamic Copy of Live Card -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#FAF6F0] border-t border-[#E8E2D9] py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-xs text-[#6E675F]">
            Studio Thiết Kế Thiệp Mời • Tinh Khôi Wedding © 2025
        </div>
    </footer>

    <script src="tk.js"></script>
</body>
</html>
