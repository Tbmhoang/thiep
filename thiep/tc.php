<?php
require_once 'db.php';

// Handle AJAX Review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_review') {
    header('Content-Type: application/json');
    $name = trim($_POST['user_name'] ?? '');
    $info = trim($_POST['wedding_info'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $rating = intval($_POST['rating'] ?? 5);

    if ($name && $comment && $pdo) {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_name, wedding_info, rating, comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $info ?: 'Người dùng Thiệp Mời', $rating, $comment]);
        echo json_encode(['status' => 'success', 'message' => 'Cảm ơn bạn đã chia sẻ đánh giá!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Vui lòng nhập đầy đủ thông tin.']);
    }
    exit;
}

# Fetch reviews from database
$reviews = [];
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM reviews ORDER BY id DESC LIMIT 6");
        $reviews = $stmt->fetchAll();
    } catch (Exception $e) {
        $reviews = [];
    }
}
if (empty($reviews)) {
    $reviews = [
        ['user_name' => 'Thanh Tùng & Bảo Ngọc', 'wedding_info' => 'Tiệc cưới tại Park Hyatt Saigon', 'rating' => 5, 'comment' => 'Mẫu thiệp Cổ Điển Hoàng Gia thực sự nâng tầm tiệc cưới của chúng tôi. Bạn bè nhận link thiệp ai cũng trầm trồ khen ngợi!'],
        ['user_name' => 'Đức Minh & Khánh Linh', 'wedding_info' => 'Tiệc cưới tại JW Marriott Hanoi', 'rating' => 5, 'comment' => 'Hệ thống RSVP thông minh giúp vợ chồng mình kiểm soát chính xác lượng khách tham dự, xuất file PDF in cũng rất sắc nét.'],
        ['user_name' => 'Văn Hậu & Thùy Dương', 'wedding_info' => 'Tiệc ngoài trời tại Đà Lạt', 'rating' => 5, 'comment' => 'Mẫu Vườn Địa Đàng với dải lụa xanh xô thơm tuyệt đẹp, giao diện tùy biến mượt mà vô cùng!']
    ];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiệp Mời - Nghệ Thuật Thiệp Cưới Điện Tử Cao Cấp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="tc.css">
</head>
<body class="bg-[#FAF8F5] text-[#2D2A26] font-['Plus_Jakarta_Sans'] antialiased">

    <!-- Header Navigation -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-[#E8E2D9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
            <a href="tc.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#C5A880]/20 border border-[#C5A880] flex items-center justify-center text-[#9A7B4F] font-serif font-bold text-lg">TM</div>
                <div class="flex flex-col">
                    <span class="font-serif font-bold text-lg tracking-wider text-[#2D2A26] group-hover:text-[#9A7B4F] transition-colors">THIỆP MỜI</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-[#9A7B4F]">Nghệ Thuật Thiệp Cưới Điện Tử</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-8 font-medium text-xs uppercase tracking-[0.18em]">
                <a href="tc.php" class="text-[#9A7B4F] border-b-2 border-[#9A7B4F] pb-1 font-semibold">Trang Chủ & Mẫu Thiệp</a>
                <a href="tk.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Studio Thiết Kế</a>
                <a href="ht.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Trung Tâm Hỗ Trợ</a>
            </nav>

            <div class="flex items-center gap-3">
                <button onclick="openAuthModal()" class="px-4 py-2 border border-[#C5A880] text-[#9A7B4F] hover:bg-[#C5A880] hover:text-white transition-all text-xs font-semibold uppercase tracking-wider rounded">
                    Đăng Nhập / Đăng Ký
                </button>
                <a href="tk.php" class="px-5 py-2.5 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.16em] font-semibold rounded transition-all shadow-sm">
                    Bắt Đầu Tạo Thiệp
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="relative py-20 lg:py-28 overflow-hidden bg-gradient-to-b from-[#FAF8F5] via-[#F3ECE0]/40 to-[#FAF8F5]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#C5A880]/15 text-[#9A7B4F] text-xs font-semibold uppercase tracking-[0.2em] border border-[#C5A880]/30">
                            <span class="w-2 h-2 rounded-full bg-[#9A7B4F] animate-ping"></span>
                            Bộ Sưu Tập Thiệp Cưới Cao Cấp 2025
                        </div>
                        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-[#2D2A26] leading-tight font-bold">
                            Chạm Vào Cảm Xúc,<br>
                            <span class="text-[#9A7B4F] italic font-normal">Lan Tỏa Ngày Hạnh Phúc</span>
                        </h1>
                        <p class="text-base sm:text-lg text-[#6E675F] max-w-2xl leading-relaxed italic">
                            Nền tảng khởi tạo thiệp cưới điện tử sang trọng. Kết hợp tinh hoa mỹ thuật thủ công với công nghệ điểm danh RSVP thông minh, bản đồ dẫn đường và xuất file in ấn chuẩn chế bản.
                        </p>
                        <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 pt-4">
                            <a href="#gallery-templates" class="px-8 py-4 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.2em] font-semibold rounded shadow-md transition-all">
                                Khám Phá Các Mẫu Thiệp
                            </a>
                            <a href="tk.php" class="px-8 py-4 border border-[#D4AF37] text-[#2D2A26] hover:bg-[#F3ECE0] text-xs uppercase tracking-[0.2em] font-semibold rounded transition-all flex items-center gap-2">
                                Tự Thiết Kế Ngay
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="lg:col-span-5 relative flex justify-center">
                        <div class="relative w-full max-w-md aspect-[3/4] rounded-2xl bg-white p-4 shadow-2xl border-4 border-[#E2C792] overflow-hidden transform rotate-1 hover:rotate-0 transition-transform duration-500">
                            <img src="img/1.png" alt="Mẫu thiệp hoàng gia" class="w-full h-full object-cover rounded-xl">
                            <div class="absolute bottom-6 inset-x-6 bg-white/90 backdrop-blur-md p-4 rounded-xl text-center border border-[#C5A880]/40 shadow-lg">
                                <span class="font-serif text-lg font-bold text-[#2D2A26] block">Hoàng Nam & Mai Linh</span>
                                <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-semibold block mt-1">Hôn Lễ Hoàng Gia • Saigon</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Template Gallery Section -->
        <section id="gallery-templates" class="py-20 max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-semibold block mb-2">Bộ Sưu Tập Tuyển Chọn</span>
                <h2 class="font-serif text-3xl sm:text-4xl text-[#2D2A26] font-bold">4 Phong Cách Thiệp Cưới Độc Bản</h2>
                <div class="w-16 h-0.5 bg-[#9A7B4F] mx-auto mt-4"></div>
                <p class="text-sm text-[#6E675F] mt-4 italic">Được sáng tác riêng cho từng nét cá tính nghệ thuật, mang đến cảm xúc sâu lắng nhất cho ngày trọng đại.</p>
            </div>

            <!-- Grid 4 Distinct Invitation Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                
                <!-- 1. Cổ Điển Hoàng Gia -->
                <div class="bg-white rounded-2xl border-2 border-[#D4AF37]/50 p-6 shadow-lg hover:shadow-2xl transition-all flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-[#781b25] text-[#F3ECE0] px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider shadow">
                        Château Royale
                    </div>
                    <div>
                        <div class="w-full h-64 rounded-xl bg-[#FAF6F0] p-4 border border-[#C5A880]/40 flex items-center justify-center relative overflow-hidden mb-6">
                            <img src="img/1.png" alt="Cổ Điển Hoàng Gia" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-bold block mb-1">Phong Cách I • Hoàng Gia</span>
                        <h3 class="font-serif text-2xl font-bold text-[#2D2A26] mb-2">Cổ Điển Hoàng Gia & Huy Hiệu Monogram</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Chất liệu giấy Crane Lettra 450gsm, viền Baroque dát vàng 24K, dấu sáp đỏ Burgundy niêm phong và lịch trình nghi lễ High Protocol trang trọng.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#E8E2D9] flex items-center justify-between gap-3">
                        <button onclick="openPreviewModal('royal')" class="flex-1 py-3 bg-[#FAF8F5] hover:bg-[#F3ECE0] text-[#2D2A26] text-xs uppercase tracking-wider font-semibold rounded border border-[#C5A880] transition-colors">
                            Xem Thử Bản Mẫu
                        </button>
                        <a href="tk.php?style=royal" class="flex-1 py-3 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-wider font-semibold rounded text-center transition-colors shadow-sm">
                            Dùng Mẫu Này
                        </a>
                    </div>
                </div>

                <!-- 2. Tối Giản Hiện Đại -->
                <div class="bg-[#F6F4F0] rounded-2xl border border-[#A8AEA9]/50 p-6 shadow-lg hover:shadow-2xl transition-all flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-[#4A504C] text-white px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider shadow">
                        Nordic Minimalist
                    </div>
                    <div>
                        <div class="w-full h-64 rounded-xl bg-white p-4 border border-[#A8AEA9]/30 flex items-center justify-center relative overflow-hidden mb-6">
                            <img src="img/3.png" alt="Tối Giản Hiện Đại" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-[#4A504C] font-bold block mb-1">Phong Cách II • Bắc Âu</span>
                        <h3 class="font-serif text-2xl font-bold text-[#2D2A26] mb-2">Tối Giản Bắc Âu & Giấy Xé Mép Deckle Edge</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Cạnh giấy mộc Deckle Edge rách tay thủ công, kỹ thuật dập chìm mộc Blind Deboss không màu, khoảng thở rộng tinh tế và thực đơn Wabi-sabi.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#E8E2D9] flex items-center justify-between gap-3">
                        <button onclick="openPreviewModal('minimal')" class="flex-1 py-3 bg-white hover:bg-[#EAE8E4] text-[#2D2A26] text-xs uppercase tracking-wider font-semibold rounded border border-[#A8AEA9] transition-colors">
                            Xem Thử Bản Mẫu
                        </button>
                        <a href="tk.php?style=minimal" class="flex-1 py-3 bg-[#4A504C] hover:bg-[#323633] text-white text-xs uppercase tracking-wider font-semibold rounded text-center transition-colors shadow-sm">
                            Dùng Mẫu Này
                        </a>
                    </div>
                </div>

                <!-- 3. Vườn Địa Đàng -->
                <div class="bg-[#F4F7F4] rounded-2xl border border-[#889B88]/50 p-6 shadow-lg hover:shadow-2xl transition-all flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-[#4E6B4E] text-white px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider shadow">
                        Botanical Garden
                    </div>
                    <div>
                        <div class="w-full h-64 rounded-xl bg-white p-4 border border-[#889B88]/30 flex items-center justify-center relative overflow-hidden mb-6">
                            <img src="img/2.png" alt="Vườn Địa Đàng" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-[#4E6B4E] font-bold block mb-1">Phong Cách III • Vườn Thơ</span>
                        <h3 class="font-serif text-2xl font-bold text-[#2D2A26] mb-2">Vườn Địa Đàng & Dải Lụa Xanh Xô Thơm</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Tranh màu nước cành ô liu và hoa bách thảo, buộc nơ dải lụa Chiffon Sage Green mềm mại, mang giai điệu lãng mạn của tiệc trà ngoài trời.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#E8E2D9] flex items-center justify-between gap-3">
                        <button onclick="openPreviewModal('botanical')" class="flex-1 py-3 bg-white hover:bg-[#E2E8E2] text-[#2D2A26] text-xs uppercase tracking-wider font-semibold rounded border border-[#889B88] transition-colors">
                            Xem Thử Bản Mẫu
                        </button>
                        <a href="tk.php?style=botanical" class="flex-1 py-3 bg-[#4E6B4E] hover:bg-[#384A38] text-white text-xs uppercase tracking-wider font-semibold rounded text-center transition-colors shadow-sm">
                            Dùng Mẫu Này
                        </a>
                    </div>
                </div>

                <!-- 4. Hiện Đại Sang Trọng -->
                <div class="bg-[#1C1917] text-[#EDE8E1] rounded-2xl border border-[#443E38] p-6 shadow-xl hover:shadow-2xl transition-all flex flex-col justify-between group relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-[#E0C298] text-[#1C1917] px-3 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider shadow">
                        Nocturne Luxury
                    </div>
                    <div>
                        <div class="w-full h-64 rounded-xl bg-[#262320] p-4 border border-[#443E38] flex items-center justify-center relative overflow-hidden mb-6">
                            <img src="img/4.png" alt="Hiện Đại Sang Trọng" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <span class="text-xs uppercase tracking-[0.2em] text-[#E0C298] font-bold block mb-1">Phong Cách IV • Black Tie</span>
                        <h3 class="font-serif text-2xl font-bold text-[#FBF9F5] mb-2">Hiện Đại Sang Trọng & Sắc Đen Than Chì</h3>
                        <p class="text-sm text-[#A89F91] leading-relaxed">
                            Giấy nhung đen Curious Skin 380gsm dát vàng gương Mirror Gold, bìa mờ Vellum trong suốt, phong cách vé mời VIP admission pass thượng đỉnh.
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#443E38] flex items-center justify-between gap-3">
                        <button onclick="openPreviewModal('nocturne')" class="flex-1 py-3 bg-[#2D2925] hover:bg-[#3D3732] text-[#E0C298] text-xs uppercase tracking-wider font-semibold rounded border border-[#E0C298]/40 transition-colors">
                            Xem Thử Bản Mẫu
                        </button>
                        <a href="tk.php?style=nocturne" class="flex-1 py-3 bg-[#E0C298] hover:bg-[#C9A970] text-[#1C1917] text-xs uppercase tracking-wider font-semibold rounded text-center transition-colors shadow-sm">
                            Dùng Mẫu Này
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- Process Section: Hoàn thiện thiệp mời của bản thân -->
        <section class="py-20 bg-[#F3ECE0]/50 border-y border-[#E8E2D9]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-semibold block mb-2">Quy Trình Hướng Dẫn</span>
                    <h2 class="font-serif text-3xl sm:text-4xl text-[#2D2A26] font-bold">Hoàn Thiện Thiệp Mời Của Bản Thân</h2>
                    <p class="text-sm text-[#6E675F] mt-2 italic">Chỉ với 3 bước hướng dẫn đơn giản để tạo nên tác phẩm thiệp mời độc bản.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Step 1 -->
                    <div class="bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full bg-[#FAF8F5] border-2 border-[#9A7B4F] flex items-center justify-center font-serif text-2xl font-bold text-[#9A7B4F] mb-6 shadow-inner">
                            01
                        </div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26] mb-3">Chọn Phong Cách Thiệp</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Lựa chọn 1 trong 4 mẫu thiệp cốt lõi (Cổ Điển Hoàng Gia, Tối Giản Bắc Âu, Vườn Địa Đàng, Hiện Đại Sang Trọng) phù hợp với phong vị lễ cưới của bạn.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full bg-[#FAF8F5] border-2 border-[#9A7B4F] flex items-center justify-center font-serif text-2xl font-bold text-[#9A7B4F] mb-6 shadow-inner">
                            02
                        </div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26] mb-3">Tùy Biến Studio & Tải Ảnh</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Cập nhật thông tin cô dâu chú rể, ngày giờ, địa điểm, tải ảnh cưới cá nhân và kiểm tra khung xem trước trực quan Live đồng bộ thời gian thực.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-full bg-[#FAF8F5] border-2 border-[#9A7B4F] flex items-center justify-center font-serif text-2xl font-bold text-[#9A7B4F] mb-6 shadow-inner">
                            03
                        </div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26] mb-3">Xuất Bản & Chia Sẻ</h3>
                        <p class="text-sm text-[#6E675F] leading-relaxed">
                            Nhận đường link website thiệp riêng tư để gửi bạn bè, hoặc xuất file in PDF 300 DPI và file ảnh PNG sắc nét lưu trữ kỷ niệm.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section: Chia sẻ từ người dùng thiệp -->
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-semibold block mb-2">Trải Nghiệm Thực Tế</span>
                <h2 class="font-serif text-3xl sm:text-4xl text-[#2D2A26] font-bold">Chia Sẻ Từ Người Dùng Thiệp</h2>
                <div class="w-16 h-0.5 bg-[#9A7B4F] mx-auto mt-4"></div>
            </div>

            <!-- Existing Reviews List -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" id="reviews-list">
                <?php foreach ($reviews as $rev): ?>
                <div class="bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex text-[#D4AF37]">
                            <?php for ($i = 0; $i < ($rev['rating'] ?? 5); $i++): ?>
                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                            <?php endfor; ?>
                        </div>
                        <p class="text-sm text-[#2D2A26] italic leading-relaxed">
                            "<?= htmlspecialchars($rev['comment']) ?>"
                        </p>
                    </div>
                    <div class="pt-6 mt-6 border-t border-[#E8E2D9]">
                        <h4 class="font-serif font-bold text-[#2D2A26]"><?= htmlspecialchars($rev['user_name']) ?></h4>
                        <p class="text-xs text-[#9A7B4F] uppercase tracking-wider mt-0.5"><?= htmlspecialchars($rev['wedding_info']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Add Review Form -->
            <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl border border-[#C5A880]/40 shadow-md">
                <h3 class="font-serif text-2xl font-bold text-[#2D2A26] text-center mb-2">Gửi Chia Sẻ Trải Nghiệm Của Bạn</h3>
                <p class="text-xs text-[#6E675F] text-center italic mb-6">Đóng góp ý kiến giúp Tinh Khôi Wedding nâng cao chất lượng dịch vụ thiệp cưới.</p>

                <form id="review-form" onsubmit="submitReview(event)" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Tên Cặp Đôi / Người Dùng *</label>
                            <input type="text" name="user_name" required placeholder="VD: Hoàng Nam & Mai Linh" class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Thông Tin Tiệc Cưới</label>
                            <input type="text" name="wedding_info" placeholder="VD: Tiệc cưới tại TP.HCM" class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Nội Dung Đánh Giá *</label>
                        <textarea name="comment" required rows="3" placeholder="Chia sẻ cảm nhận của bạn về giao diện, tính năng thiệp mời..." class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F] resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.2em] font-semibold rounded transition-colors shadow">
                        Gửi Đánh Giá Ngay
                    </button>
                    <div id="review-msg" class="text-center text-xs font-semibold mt-2 hidden"></div>
                </form>
            </div>
        </section>
    </main>

    <!-- Modal Xem Thử Mẫu Thiệp Kích Thước Lớn -->
    <div id="preview-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden relative my-8 my-auto">
            <button onclick="closePreviewModal()" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/10 hover:bg-black/20 text-[#2D2A26] flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div id="modal-content" class="p-6 sm:p-10 max-h-[85vh] overflow-y-auto">
                <!-- Injected dynamically via tc.js -->
            </div>
        </div>
    </div>

    <!-- Modal Đăng Nhập / Đăng Ký -->
    <div id="auth-modal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-8 relative">
            <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <span class="material-symbols-outlined">close</span>
            </button>
            
            <div class="flex border-b border-[#E8E2D9] mb-6">
                <button id="tab-login" onclick="switchAuthTab('login')" class="flex-1 pb-3 text-center text-xs uppercase tracking-wider font-bold border-b-2 border-[#9A7B4F] text-[#9A7B4F]">Đăng Nhập</button>
                <button id="tab-register" onclick="switchAuthTab('register')" class="flex-1 pb-3 text-center text-xs uppercase tracking-wider font-bold border-b-2 border-transparent text-gray-400">Đăng Ký</button>
            </div>

            <!-- Login Form -->
            <form id="form-login" onsubmit="event.preventDefault(); alert('Đăng nhập thành công!'); closeAuthModal();" class="space-y-4">
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Tên Đăng Nhập / Email</label>
                    <input type="text" required class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Mật Khẩu</label>
                    <input type="password" required class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                </div>
                <button type="submit" class="w-full py-3 bg-[#9A7B4F] text-white text-xs uppercase tracking-[0.18em] font-semibold rounded hover:bg-[#83633C] transition-colors">
                    Đăng Nhập Tức Thì
                </button>
            </form>

            <!-- Register Form -->
            <form id="form-register" onsubmit="event.preventDefault(); alert('Đăng ký tài khoản thành công!'); closeAuthModal();" class="space-y-4 hidden">
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Họ và Tên</label>
                    <input type="text" required class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Email</label>
                    <input type="email" required class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Mật Khẩu</label>
                    <input type="password" required class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                </div>
                <button type="submit" class="w-full py-3 bg-[#9A7B4F] text-white text-xs uppercase tracking-[0.18em] font-semibold rounded hover:bg-[#83633C] transition-colors">
                    Tạo Tài Khoản Mới
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#FAF6F0] border-t border-[#E8E2D9] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center space-y-4">
            <div class="font-serif font-bold text-xl text-[#2D2A26]">THIỆP MỜI • TINH KHÔI WEDDING</div>
            <p class="text-xs text-[#6E675F] uppercase tracking-[0.2em]">Nghệ Thuật Thiệp Cưới Điện Tử Cao Cấp • Bảo Lưu Mọi Quyền © 2025</p>
        </div>
    </footer>

    <script src="tc.js"></script>
</body>
</html>
