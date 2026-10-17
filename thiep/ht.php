<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung Tâm Hỗ Trợ - Thiệp Mời Tinh Khôi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="ht.css">
</head>
<body class="bg-[#FAF8F5] text-[#2D2A26] font-['Plus_Jakarta_Sans'] antialiased">

    <!-- Header Navigation -->
    <header class="fixed top-0 inset-x-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b border-[#E8E2D9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
            <a href="tc.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-[#C5A880]/20 border border-[#C5A880] flex items-center justify-center text-[#9A7B4F] font-serif font-bold text-lg">TM</div>
                <div class="flex flex-col">
                    <span class="font-serif font-bold text-lg tracking-wider text-[#2D2A26] group-hover:text-[#9A7B4F] transition-colors">TRUNG TÂM HỖ TRỢ</span>
                    <span class="text-[10px] uppercase tracking-[0.2em] text-[#9A7B4F]">Cẩm Nang & Giải Đáp</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-8 font-medium text-xs uppercase tracking-[0.18em]">
                <a href="tc.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Trang Chủ & Mẫu Thiệp</a>
                <a href="tk.php" class="text-[#5A554E] hover:text-[#9A7B4F] transition-colors">Studio Thiết Kế</a>
                <a href="ht.php" class="text-[#9A7B4F] border-b-2 border-[#9A7B4F] pb-1 font-semibold">Trung Tâm Hỗ Trợ</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="tk.php" class="px-5 py-2.5 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.16em] font-semibold rounded transition-all shadow-sm">
                    Mở Studio Thiết Kế
                </a>
            </div>
        </div>
    </header>

    <main class="pt-24 pb-20 max-w-7xl mx-auto px-4 sm:px-6 space-y-16">
        
        <!-- Search Banner -->
        <section class="text-center max-w-3xl mx-auto space-y-6 py-8">
            <span class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-bold block">Trợ Lý Vận Hành Thông Minh</span>
            <h1 class="font-serif text-3xl sm:text-4xl text-[#2D2A26] font-bold leading-tight">
                Tra Cứu Hướng Dẫn & Vận Hành Thiệp Mời
            </h1>
            <p class="text-sm text-[#6E675F] italic leading-relaxed">
                Nhập từ khóa tìm kiếm để hệ thống tự động tìm và chuyển màn hình đến khu vực nội dung hướng dẫn chi tiết tương ứng.
            </p>

            <!-- Search Bar -->
            <div class="relative max-w-2xl mx-auto flex items-center shadow-lg rounded-xl bg-white border border-[#C5A880]/40 p-2">
                <span class="material-symbols-outlined text-[#9A7B4F] text-2xl ml-3 select-none">search</span>
                <input type="text" id="manual-search-input" placeholder="Nhập từ khóa, ví dụ: xuất file pdf, gửi link zalo, rsvp, tạo ảnh png..." class="w-full px-4 py-2.5 text-sm text-[#2D2A26] placeholder-gray-400 focus:outline-none bg-transparent">
                <button onclick="executeManualSearch()" class="px-6 py-2.5 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-wider font-semibold rounded-lg transition-colors shrink-0 shadow">
                    Tìm Kiếm
                </button>
            </div>
            <div id="search-feedback" class="text-xs font-semibold text-[#9A7B4F] hidden"></div>
        </section>

        <!-- Cẩm Nang Vận Hành Toàn Diện (Khung Dài Ngang) -->
        <section class="space-y-8">
            <div class="border-b border-[#E8E2D9] pb-4">
                <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-bold block">Tài Liệu Toàn Diện</span>
                <h2 class="font-serif text-3xl font-bold text-[#2D2A26] mt-1">Cẩm Nang Vận Hành Toàn Diện</h2>
            </div>

            <!-- Full-width Horizontal Section 1 -->
            <div id="manual-01" class="manual-card w-full bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between border-b border-[#FAF8F5] pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-[#C5A880]/15 text-[#9A7B4F] flex items-center justify-center font-bold">01</div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26]">Khởi Tạo & Thiết Kế Thiệp Mời</h3>
                    </div>
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold bg-[#FAF8F5] px-3 py-1 rounded-full border border-[#C5A880]/30">Bắt Đầu</span>
                </div>
                <div class="text-sm text-[#6E675F] leading-relaxed space-y-3">
                    <p>
                        Quy trình khởi tạo bắt đầu bằng việc điền đầy đủ thông tin cô dâu chú rể, tên hai họ và chi tiết lịch trình tổ chức tiệc. Người dùng có thể lựa chọn 1 trong 4 mẫu thiệp cốt lõi được thiết kế theo chuẩn haute papeterie:
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-xs text-gray-700">
                        <li><strong>Cổ Điển Hoàng Gia:</strong> Điểm nhấn dấu sáp niêm phong đỏ Burgundy, viền Baroque dát vàng 24K, phông chữ Playfair cổ điển.</li>
                        <li><strong>Tối Giản Bắc Âu:</strong> Giấy xé mép Deckle Edge mộc mạc, hiệu ứng dập chìm mộc Blind Deboss, tông màu đất tĩnh lặng.</li>
                        <li><strong>Vườn Địa Đàng:</strong> Tranh màu nước cành ô liu bách thảo, buộc nơ dải lụa Chiffon Sage Green mềm mại.</li>
                        <li><strong>Hiện Đại Sang Trọng:</strong> Nền nhung đen Curious Skin 380gsm dát vàng gương Mirror Gold, kẹp bìa Vellum trong suốt.</li>
                    </ul>
                </div>
            </div>

            <!-- Full-width Horizontal Section 2 -->
            <div id="manual-02" class="manual-card w-full bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between border-b border-[#FAF8F5] pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-[#C5A880]/15 text-[#9A7B4F] flex items-center justify-center font-bold">02</div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26]">Quản Lý Khách Mời & RSVP Smart</h3>
                    </div>
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold bg-[#FAF8F5] px-3 py-1 rounded-full border border-[#C5A880]/30">Thống Kê</span>
                </div>
                <div class="text-sm text-[#6E675F] leading-relaxed space-y-3">
                    <p>
                        Hệ thống RSVP tự động thu thập thông tin xác nhận tham dự của khách mời bao gồm: họ tên, số lượng đi kèm (+1, +2), chế độ ăn uống (ăn chay, dị ứng) và những lời chúc phúc ấm áp. Mọi dữ liệu được đồng bộ trực tiếp vào cơ sở dữ liệu và bảng báo cáo sơ bộ giúp cặp đôi dễ dàng xếp bàn tiệc mà không lo thất lạc.
                    </p>
                </div>
            </div>

            <!-- Full-width Horizontal Section 3 -->
            <div id="manual-03" class="manual-card w-full bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between border-b border-[#FAF8F5] pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-[#C5A880]/15 text-[#9A7B4F] flex items-center justify-center font-bold">03</div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26]">Đa Phương Tiện & Hình Ảnh Cưới</h3>
                    </div>
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold bg-[#FAF8F5] px-3 py-1 rounded-full border border-[#C5A880]/30">Media</span>
                </div>
                <div class="text-sm text-[#6E675F] leading-relaxed space-y-3">
                    <p>
                        Chèn hình ảnh chân dung hoặc khoảnh khắc kỷ niệm trực tiếp vào thiệp thông qua kho ảnh mẫu sẵn (`1.png`, `2.png`, `3.png`, `4.png`) hoặc tải lên tệp ảnh riêng từ thiết bị. Hệ thống tự động tối ưu hóa nén dung lượng ảnh để đảm bảo tốc độ tải trang dưới 0.6 giây trên mọi trình duyệt di động iOS và Android.
                    </p>
                </div>
            </div>

            <!-- Full-width Horizontal Section 4 -->
            <div id="manual-04" class="manual-card w-full bg-white p-8 rounded-2xl border border-[#E8E2D9] shadow-sm hover:shadow-md transition-all space-y-4">
                <div class="flex items-center justify-between border-b border-[#FAF8F5] pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-[#C5A880]/15 text-[#9A7B4F] flex items-center justify-center font-bold">04</div>
                        <h3 class="font-serif text-xl font-bold text-[#2D2A26]">Xuất Bản, Chia Sẻ Link & Tải File (PDF/PNG)</h3>
                    </div>
                    <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold bg-[#FAF8F5] px-3 py-1 rounded-full border border-[#C5A880]/30">Phát Hành</span>
                </div>
                <div class="text-sm text-[#6E675F] leading-relaxed space-y-3">
                    <p>
                        Cung cấp 2 kênh phát hành chính:
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-xs text-gray-700">
                        <li><strong>Đường link website thiệp riêng:</strong> Tạo đường dẫn riêng tư (ví dụ: `tk.php?id=1`). Khi người khác nhấp vào link này sẽ mở ra trang web hình ảnh thiệp mời đầy đủ mượt mà.</li>
                        <li><strong>Xuất file PDF in ấn:</strong> Tạo file vector Press-Ready 300 DPI hệ màu CMYK có tràn lề bù xén chuẩn xưởng in.</li>
                        <li><strong>Xuất file Ảnh PNG:</strong> Tạo file ảnh đơn PNG HD sắc nét để chia sẻ qua Zalo, Messenger hoặc lưu giữ kỷ niệm.</li>
                    </ul>
                </div>
            </div>

        </section>

        <!-- FAQ Section: Câu hỏi thường gặp -->
        <section class="space-y-8">
            <div class="border-b border-[#E8E2D9] pb-4">
                <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-bold block">Giải Đáp Thắc Mắc</span>
                <h2 class="font-serif text-3xl font-bold text-[#2D2A26] mt-1">Câu Hỏi Thường Gặp</h2>
            </div>

            <div class="space-y-4" id="faq-container">
                <!-- FAQ 1 -->
                <div class="faq-item rounded-2xl bg-white border border-[#E8E2D9] shadow-sm overflow-hidden transition-all">
                    <button onclick="toggleFaq(this)" class="w-full p-6 text-left flex items-center justify-between font-serif font-bold text-lg text-[#2D2A26] focus:outline-none">
                        <span>1. Khách mời có cần tải ứng dụng để mở link thiệp không?</span>
                        <span class="material-symbols-outlined text-[#9A7B4F] faq-icon transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 pt-1 text-sm text-[#6E675F] leading-relaxed border-t border-[#FAF8F5]">
                        Hoàn toàn không cần tải ứng dụng. Thiệp cưới Tinh Khôi mở mượt mà lập tức trên mọi trình duyệt web (Safari, Chrome, Cốc Cốc, Zalo In-App Browser) trên điện thoại, máy tính bảng và máy tính.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item rounded-2xl bg-white border border-[#E8E2D9] shadow-sm overflow-hidden transition-all">
                    <button onclick="toggleFaq(this)" class="w-full p-6 text-left flex items-center justify-between font-serif font-bold text-lg text-[#2D2A26] focus:outline-none">
                        <span>2. Tôi có thể sửa lại thông tin sau khi đã chia sẻ link không?</span>
                        <span class="material-symbols-outlined text-[#9A7B4F] faq-icon transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 pt-1 text-sm text-[#6E675F] leading-relaxed border-t border-[#FAF8F5]">
                        Có, mọi chỉnh sửa trên Studio đều tự động cập nhật thời gian thực. Khách mời khi mở lại đường link cũ sẽ nhìn thấy ngay thông tin mới nhất mà bạn không cần phải gửi đường link khác.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item rounded-2xl bg-white border border-[#E8E2D9] shadow-sm overflow-hidden transition-all">
                    <button onclick="toggleFaq(this)" class="w-full p-6 text-left flex items-center justify-between font-serif font-bold text-lg text-[#2D2A26] focus:outline-none">
                        <span>3. Làm thế nào để xuất file PDF chuẩn 300 DPI mang ra nhà in?</span>
                        <span class="material-symbols-outlined text-[#9A7B4F] faq-icon transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 pt-1 text-sm text-[#6E675F] leading-relaxed border-t border-[#FAF8F5]">
                        Tại màn hình Studio Thiết Kế, bạn chỉ cần nhấn vào nút "Tải File PDF". Hệ thống sẽ renders tự động bản thiết kế thành tệp PDF chất lượng cao 300 DPI để bạn gửi thẳng cho xưởng in.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item rounded-2xl bg-white border border-[#E8E2D9] shadow-sm overflow-hidden transition-all">
                    <button onclick="toggleFaq(this)" class="w-full p-6 text-left flex items-center justify-between font-serif font-bold text-lg text-[#2D2A26] focus:outline-none">
                        <span>4. Cách xuất file ảnh PNG HD để gửi Zalo/Messenger?</span>
                        <span class="material-symbols-outlined text-[#9A7B4F] faq-icon transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 pt-1 text-sm text-[#6E675F] leading-relaxed border-t border-[#FAF8F5]">
                        Nhấn nút "Tải Ảnh PNG" tại thanh công cụ hoặc phần Xuất bản. File ảnh PNG HD sắc nét sẽ tự động tải về thiết bị của bạn.
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="faq-item rounded-2xl bg-white border border-[#E8E2D9] shadow-sm overflow-hidden transition-all">
                    <button onclick="toggleFaq(this)" class="w-full p-6 text-left flex items-center justify-between font-serif font-bold text-lg text-[#2D2A26] focus:outline-none">
                        <span>5. Dữ liệu kỷ niệm và phản hồi RSVP được lưu trữ bao lâu?</span>
                        <span class="material-symbols-outlined text-[#9A7B4F] faq-icon transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer hidden px-6 pb-6 pt-1 text-sm text-[#6E675F] leading-relaxed border-t border-[#FAF8F5]">
                        Toàn bộ kho lưu trữ ảnh kỷ niệm và danh sách lời chúc RSVP của bạn sẽ được bảo tồn vĩnh viễn trên máy chủ đám mây riêng biệt để kỷ niệm 5 năm, 10 năm ngày cưới sau này.
                    </div>
                </div>
            </div>
        </section>

        <!-- Khám Phá Câu Chuyện (Đánh Giá & Chia Sẻ Trải Nghiệm) -->
        <section class="space-y-8">
            <div class="border-b border-[#E8E2D9] pb-4">
                <span class="text-xs uppercase tracking-[0.2em] text-[#9A7B4F] font-bold block">Góc Cảm Nhận</span>
                <h2 class="font-serif text-3xl font-bold text-[#2D2A26] mt-1">Khám Phá Câu Chuyện & Đánh Giá Website</h2>
                <p class="text-sm text-[#6E675F] mt-1 italic">Nơi khách hàng gửi gắm những câu chuyện trải nghiệm và đánh giá thực tế về trang web thiệp mời.</p>
            </div>

            <!-- Experience Form -->
            <div class="bg-white p-8 rounded-2xl border border-[#C5A880]/40 shadow-md max-w-3xl mx-auto space-y-4">
                <h3 class="font-serif text-xl font-bold text-[#2D2A26] text-center">Chia Sẻ Trải Nghiệm Của Bạn</h3>
                
                <form id="story-form" onsubmit="addStory(event)" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Tên Của Bạn *</label>
                            <input type="text" id="story-name" required placeholder="VD: Hoàng Nam" class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Mẫu Thiệp Đã Dùng</label>
                            <input type="text" id="story-style" placeholder="VD: Cổ Điển Hoàng Gia" class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider text-[#6E675F] mb-1 font-semibold">Câu Chuyện & Cảm Nhận *</label>
                        <textarea id="story-content" required rows="3" placeholder="Mô tả trải nghiệm của bạn khi thiết kế và gửi thiệp..." class="w-full px-3 py-2 rounded bg-[#FAF8F5] border border-[#E8E2D9] text-sm focus:outline-none focus:border-[#9A7B4F] resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full py-3 bg-[#9A7B4F] hover:bg-[#83633C] text-white text-xs uppercase tracking-[0.2em] font-semibold rounded transition-colors shadow">
                        Gửi Câu Chuyện Ngay
                    </button>
                </form>
            </div>

            <!-- Dynamic Story Cards List -->
            <div id="stories-list" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-[#E8E2D9] shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-serif font-bold text-[#2D2A26]">Lê Hoàng & Mai Anh</span>
                        <span class="text-xs text-[#9A7B4F] uppercase font-semibold">Mẫu Tối Giản Bắc Âu</span>
                    </div>
                    <p class="text-sm text-[#6E675F] italic">
                        "Trang web thiết kế mượt mà, đồng bộ trực tiếp nhanh vô cùng. Người thân khi nhận được link ai cũng khen giao diện quá đẳng cấp!"
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-[#E8E2D9] shadow-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="font-serif font-bold text-[#2D2A26]">Minh Nhật & Thảo Vy</span>
                        <span class="text-xs text-[#9A7B4F] uppercase font-semibold">Mẫu Vườn Địa Đàng</span>
                    </div>
                    <p class="text-sm text-[#6E675F] italic">
                        "Tính năng xuất file PDF 300 DPI rất đỉnh, xưởng in in ra sắc nét y hệt như bản xem trước trên màn hình."
                    </p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-[#FAF6F0] border-t border-[#E8E2D9] py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center text-xs text-[#6E675F]">
            Trung Tâm Hỗ Trợ • Thiệp Mời Tinh Khôi © 2025
        </div>
    </footer>

    <script src="ht.js"></script>
</body>
</html>
