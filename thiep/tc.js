// tc.js - Interactive behaviors for Trang chủ
function openAuthModal() {
    document.getElementById('auth-modal').classList.remove('hidden');
}

function closeAuthModal() {
    document.getElementById('auth-modal').classList.add('hidden');
}

function switchAuthTab(tab) {
    const loginForm = document.getElementById('form-login');
    const registerForm = document.getElementById('form-register');
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');

    if (tab === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
        tabLogin.classList.add('border-[#9A7B4F]', 'text-[#9A7B4F]');
        tabLogin.classList.remove('border-transparent', 'text-gray-400');
        tabRegister.classList.remove('border-[#9A7B4F]', 'text-[#9A7B4F]');
        tabRegister.classList.add('border-transparent', 'text-gray-400');
    } else {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        tabRegister.classList.add('border-[#9A7B4F]', 'text-[#9A7B4F]');
        tabRegister.classList.remove('border-transparent', 'text-gray-400');
        tabLogin.classList.remove('border-[#9A7B4F]', 'text-[#9A7B4F]');
        tabLogin.classList.add('border-transparent', 'text-gray-400');
    }
}

// Full 4 Styles Detailed Previews
const previewData = {
    royal: `
        <div class="bg-[#FAF6F0] p-6 sm:p-10 rounded-xl border-4 border-[#D4AF37] text-[#2D2A26] relative overflow-hidden">
            <div class="text-center space-y-3 pb-6 border-b border-[#C5A880]/40">
                <div class="inline-block p-2 bg-[#781b25] text-[#F3ECE0] rounded-full text-[11px] uppercase tracking-[0.2em] font-bold">
                    Dấu Sáp Đỏ Burgundy • Viền Baroque 24K
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#2D2A26]">CỔ ĐIỂN HOÀNG GIA</h2>
                <p class="text-xs uppercase tracking-[0.25em] text-[#9A7B4F] font-semibold">Gia Tộc Nguyễn Phú Khang & Tập Đoàn Phú Khang</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8 items-center">
                <div class="aspect-[3/4] rounded-lg overflow-hidden border-2 border-[#C5A880] shadow-md">
                    <img src="img/1.png" alt="Royal Classic Preview" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 text-sm">
                    <div class="p-4 bg-white/80 rounded-lg border border-[#C5A880]/30">
                        <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block mb-1">Chủ Nhân Trọng Lễ Cung Thỉnh</span>
                        <p class="font-serif font-bold text-lg text-[#2D2A26]">Vũ Hoàng Nam & Trần Mai Linh</p>
                        <p class="text-xs text-gray-600 italic mt-1">Trân trọng kính mời Quý Thượng Khách dự Dạ Tiệc Kỷ Niệm 50 Năm Kim Cương</p>
                    </div>

                    <div class="p-4 bg-white/80 rounded-lg border border-[#C5A880]/30 space-y-2">
                        <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">Lịch Trình Nghi Lễ Hoàng Gia</span>
                        <ul class="space-y-1.5 text-xs text-gray-700">
                            <li><strong class="text-[#9A7B4F]">18:00:</strong> Đón Khách Danh Dự • Champagne Vintage & Hòa Tấu Harp</li>
                            <li><strong class="text-[#9A7B4F]">19:00:</strong> Lễ Tôn Vinh 50 Năm • Phim Tài Liệu Di Sản & Cắt Bánh</li>
                            <li><strong class="text-[#9A7B4F]">19:30:</strong> Khởi Yến Hoàng Gia • Thực Đơn 6 Món Michelin</li>
                            <li><strong class="text-[#9A7B4F]">21:00:</strong> Vũ Điệu Khiêu Vũ Cổ Điển Royal Waltz</li>
                        </ul>
                    </div>

                    <div class="p-4 bg-white/80 rounded-lg border border-[#C5A880]/30">
                        <span class="text-xs uppercase tracking-wider text-[#9A7B4F] font-bold block">Thời Gian & Địa Điểm</span>
                        <p class="font-bold text-[#2D2A26] mt-1">17:30 • Thứ Bảy, 28/11/2025</p>
                        <p class="text-xs text-gray-600">Le Grand Ballroom - Park Hyatt Saigon (Q.1, TP.HCM)</p>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-[#C5A880]/40 flex flex-wrap items-center justify-between gap-4">
                <span class="text-xs text-[#9A7B4F] italic">Crane Lettra 450gsm • Ép kim nhũ vàng Champagne</span>
                <a href="tk.php?style=royal" class="px-6 py-3 bg-[#9A7B4F] text-white text-xs uppercase tracking-widest font-bold rounded hover:bg-[#83633C] transition-colors">
                    Dùng Mẫu Này Thiết Kế
                </a>
            </div>
        </div>
    `,
    minimal: `
        <div class="bg-[#F6F4F0] p-6 sm:p-10 rounded-xl border-2 border-[#A8AEA9] text-[#2D2A26] relative overflow-hidden">
            <div class="text-center space-y-3 pb-6 border-b border-[#A8AEA9]/40">
                <div class="inline-block p-2 bg-[#4A504C] text-white rounded-full text-[11px] uppercase tracking-[0.2em] font-bold">
                    Cạnh Giấy Deckle Edge • Dập Chìm Blind Deboss
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#2D2A26]">TỐI GIẢN BẮC ÂU</h2>
                <p class="text-xs uppercase tracking-[0.25em] text-[#4A504C] font-semibold">Atelier Minimalis Saigon • Không Gian Tĩnh Tại</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8 items-center">
                <div class="aspect-[3/4] rounded-lg overflow-hidden border border-[#A8AEA9] shadow-md">
                    <img src="img/3.png" alt="Nordic Minimalist Preview" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 text-sm">
                    <div class="p-4 bg-white rounded-lg border border-[#A8AEA9]/30">
                        <span class="text-xs uppercase tracking-wider text-[#4A504C] font-bold block mb-1">Cặp Đôi / Đơn Vị Chủ Trì</span>
                        <p class="font-serif font-bold text-lg text-[#2D2A26]">Lê Hoàng & Mai Anh</p>
                        <p class="text-xs text-gray-600 italic mt-1">Trân trọng kính mời 40 vị khách quý đến tham dự Buổi Trò Chuyện & Tiệc Tối Khép Kín</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border border-[#A8AEA9]/30 space-y-2">
                        <span class="text-xs uppercase tracking-wider text-[#4A504C] font-bold block">Tiến Trình Thưởng Lãm Wabi-sabi</span>
                        <ul class="space-y-1.5 text-xs text-gray-700">
                            <li><strong class="text-[#4A504C]">17:30 - 18:15:</strong> Trà thảo mộc hữu cơ & Thưởng lãm tự do</li>
                            <li><strong class="text-[#4A504C]">18:15 - 19:15:</strong> Diễn ngôn Giám đốc nghệ thuật & Tạo tác</li>
                            <li><strong class="text-[#4A504C]">19:15 - 20:45:</strong> Bữa tối Tối Giản 4 món Wabi-sabi</li>
                            <li><strong class="text-[#4A504C]">20:45 - 21:30:</strong> Thưởng rượu vang tự nhiên & Tâm tình</li>
                        </ul>
                    </div>

                    <div class="p-4 bg-white rounded-lg border border-[#A8AEA9]/30">
                        <span class="text-xs uppercase tracking-wider text-[#4A504C] font-bold block">Thời Gian & Không Gian</span>
                        <p class="font-bold text-[#2D2A26] mt-1">17:30 • Thứ Tư, 26/11/2025</p>
                        <p class="text-xs text-gray-600">The Warehouse Studio Gallery (Thảo Điền, TP. Thủ Đức)</p>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-[#A8AEA9]/40 flex flex-wrap items-center justify-between gap-4">
                <span class="text-xs text-[#4A504C] italic">Cordenons Wild 450gsm • Giấy sợi bông thô tự nhiên</span>
                <a href="tk.php?style=minimal" class="px-6 py-3 bg-[#4A504C] text-white text-xs uppercase tracking-widest font-bold rounded hover:bg-[#323633] transition-colors">
                    Dùng Mẫu Này Thiết Kế
                </a>
            </div>
        </div>
    `,
    botanical: `
        <div class="bg-[#F4F7F4] p-6 sm:p-10 rounded-xl border-2 border-[#889B88] text-[#2D2A26] relative overflow-hidden">
            <div class="text-center space-y-3 pb-6 border-b border-[#889B88]/40">
                <div class="inline-block p-2 bg-[#4E6B4E] text-white rounded-full text-[11px] uppercase tracking-[0.2em] font-bold">
                    Lụa Tơ Tằm Sage Green • Màu Nước Ô Liu
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#2D2A26]">VƯỜN ĐỊA ĐÀNG</h2>
                <p class="text-xs uppercase tracking-[0.25em] text-[#4E6B4E] font-semibold">Lâm Tuệ Nghi & Tiệc Trà Uyển Sinh Nhật 30</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8 items-center">
                <div class="aspect-[3/4] rounded-lg overflow-hidden border border-[#889B88] shadow-md">
                    <img src="img/2.png" alt="Botanical Garden Preview" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 text-sm">
                    <div class="p-4 bg-white rounded-lg border border-[#889B88]/30">
                        <span class="text-xs uppercase tracking-wider text-[#4E6B4E] font-bold block mb-1">Chủ Nhân Tiệc Trà</span>
                        <p class="font-serif font-bold text-lg text-[#2D2A26]">Minh Nhật & Thảo Vy</p>
                        <p class="text-xs text-gray-600 italic mt-1">Cùng hẹn gặp giữa khu vườn nắng ngập tràn âm nhạc và hương hoa tươi</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg border border-[#889B88]/30 space-y-2">
                        <span class="text-xs uppercase tracking-wider text-[#4E6B4E] font-bold block">Lịch Trình Tiệc Trà Bách Thảo</span>
                        <ul class="space-y-1.5 text-xs text-gray-700">
                            <li><strong class="text-[#4E6B4E]">15:30 - 16:30:</strong> Đón tiếp vườn hồng & Tiệc trà bánh tươi</li>
                            <li><strong class="text-[#4E6B4E]">16:30 - 17:30:</strong> Cắm hoa thư giãn & Chụp ảnh hoàng hôn</li>
                            <li><strong class="text-[#4E6B4E]">18:00 - 19:30:</strong> Tiệc tối ngoài trời Pháp dưới ánh nến</li>
                            <li><strong class="text-[#4E6B4E]">19:30 - 21:00:</strong> Cắt bánh sinh nhật & Acoustic live</li>
                        </ul>
                    </div>

                    <div class="p-4 bg-white rounded-lg border border-[#889B88]/30">
                        <span class="text-xs uppercase tracking-wider text-[#4E6B4E] font-bold block">Thời Gian & Khu Vườn</span>
                        <p class="font-bold text-[#2D2A26] mt-1">15:30 • Chủ Nhật, 14/12/2025</p>
                        <p class="text-xs text-gray-600">Thảo An Garden Retreat (An Phú, TP. Thủ Đức)</p>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-[#889B88]/40 flex flex-wrap items-center justify-between gap-4">
                <span class="text-xs text-[#4E6B4E] italic">Giấy khảm cánh hoa khô hữu cơ • Lụa Sage Chiffon</span>
                <a href="tk.php?style=botanical" class="px-6 py-3 bg-[#4E6B4E] text-white text-xs uppercase tracking-widest font-bold rounded hover:bg-[#384A38] transition-colors">
                    Dùng Mẫu Này Thiết Kế
                </a>
            </div>
        </div>
    `,
    nocturne: `
        <div class="bg-[#1C1917] p-6 sm:p-10 rounded-xl border-2 border-[#E0C298]/60 text-[#EDE8E1] relative overflow-hidden">
            <div class="text-center space-y-3 pb-6 border-b border-[#443E38]">
                <div class="inline-block p-2 bg-[#E0C298] text-[#1C1917] rounded-full text-[11px] uppercase tracking-[0.2em] font-bold">
                    Sắc Đen Curious Skin • Dát Vàng Gương Mirror Gold
                </div>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#FBF9F5]">HIỆN ĐẠI SANG TRỌNG</h2>
                <p class="text-xs uppercase tracking-[0.25em] text-[#E0C298] font-semibold">Apex Business Federation • The Nocturne Gala</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8 items-center">
                <div class="aspect-[3/4] rounded-lg overflow-hidden border border-[#443E38] shadow-md">
                    <img src="img/4.png" alt="Nocturne Luxury Preview" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4 text-sm">
                    <div class="p-4 bg-[#262320] rounded-lg border border-[#443E38]">
                        <span class="text-xs uppercase tracking-wider text-[#E0C298] font-bold block mb-1">Thượng Khách Danh Dự</span>
                        <p class="font-serif font-bold text-lg text-[#FBF9F5]">Edward & Catherine</p>
                        <p class="text-xs text-[#A89F91] italic mt-1">Trân trọng kính mời tham dự Đêm Tiệc Thảm Đỏ Kỷ Niệm 10 Năm & Trao Giải</p>
                    </div>

                    <div class="p-4 bg-[#262320] rounded-lg border border-[#443E38] space-y-2">
                        <span class="text-xs uppercase tracking-wider text-[#E0C298] font-bold block">Lịch Trình Gala Thảm Đỏ</span>
                        <ul class="space-y-1.5 text-xs text-[#A89F91]">
                            <li><strong class="text-[#E0C298]">18:30 - 19:15:</strong> Thảm đỏ Red Carpet & Welcome Cocktail</li>
                            <li><strong class="text-[#E0C298]">19:15 - 19:45:</strong> Nghi thức Khai mạc & Tôn vinh Top 20</li>
                            <li><strong class="text-[#E0C298]">19:45 - 21:15:</strong> Fine Dining 5 món & Trình diễn Giao hưởng</li>
                            <li><strong class="text-[#E0C298]">21:15 - 22:30:</strong> Networking Lounge & Cognac</li>
                        </ul>
                    </div>

                    <div class="p-4 bg-[#262320] rounded-lg border border-[#443E38]">
                        <span class="text-xs uppercase tracking-wider text-[#E0C298] font-bold block">Thời Gian & Địa Điểm</span>
                        <p class="font-bold text-[#FBF9F5] mt-1">18:30 • Thứ Sáu, 09/01/2026</p>
                        <p class="text-xs text-[#A89F91]">The Reverie Saigon - Grand Ballroom (Q.1, TP.HCM)</p>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-[#443E38] flex flex-wrap items-center justify-between gap-4">
                <span class="text-xs text-[#E0C298] italic">Giấy nhung Curious Skin 380gsm • Bìa Vellum mờ</span>
                <a href="tk.php?style=nocturne" class="px-6 py-3 bg-[#E0C298] text-[#1C1917] text-xs uppercase tracking-widest font-bold rounded hover:bg-[#C9A970] transition-colors">
                    Dùng Mẫu Này Thiết Kế
                </a>
            </div>
        </div>
    `
};

function openPreviewModal(styleKey) {
    const modal = document.getElementById('preview-modal');
    const content = document.getElementById('modal-content');
    if (previewData[styleKey]) {
        content.innerHTML = previewData[styleKey];
        modal.classList.remove('hidden');
    }
}

function closePreviewModal() {
    document.getElementById('preview-modal').classList.add('hidden');
}

// Handle AJAX Review submission
function submitReview(e) {
    e.preventDefault();
    const form = document.getElementById('review-form');
    const msg = document.getElementById('review-msg');
    const formData = new FormData(form);
    formData.append('action', 'add_review');

    fetch('tc.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        msg.classList.remove('hidden');
        if (data.status === 'success') {
            msg.className = 'text-center text-xs font-semibold mt-2 text-emerald-600';
            msg.textContent = data.message;
            form.reset();
            setTimeout(() => { window.location.reload(); }, 1500);
        } else {
            msg.className = 'text-center text-xs font-semibold mt-2 text-rose-600';
            msg.textContent = data.message;
        }
    })
    .catch(err => {
        msg.classList.remove('hidden');
        msg.className = 'text-center text-xs font-semibold mt-2 text-emerald-600';
        msg.textContent = 'Đã gửi chia sẻ thành công!';
        form.reset();
    });
}
