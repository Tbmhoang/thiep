// ht.js - Interactive search, accordion, and story submission
function executeManualSearch() {
    const query = document.getElementById('manual-search-input').value.trim().toLowerCase();
    const feedback = document.getElementById('search-feedback');

    if (!query) {
        feedback.classList.remove('hidden');
        feedback.textContent = 'Vui lòng nhập từ khóa tìm kiếm.';
        return;
    }

    const cards = document.querySelectorAll('.manual-card, .faq-item');
    let found = false;

    // Reset previous highlights
    cards.forEach(card => card.classList.remove('search-highlight'));

    for (const card of cards) {
        if (card.textContent.toLowerCase().includes(query)) {
            card.classList.add('search-highlight');
            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            found = true;

            // If it's a FAQ item, auto expand it
            const answer = card.querySelector('.faq-answer');
            if (answer) {
                answer.classList.remove('hidden');
            }
            break;
        }
    }

    feedback.classList.remove('hidden');
    if (found) {
        feedback.className = 'text-xs font-semibold text-emerald-600 mt-2';
        feedback.textContent = 'Đã tìm thấy và tự động chuyển màn hình đến khu vực nội dung tương ứng.';
    } else {
        feedback.className = 'text-xs font-semibold text-rose-600 mt-2';
        feedback.textContent = 'Không tìm thấy kết quả phù hợp. Vui lòng thử lại với từ khóa khác.';
    }
}

function toggleFaq(btn) {
    const parent = btn.closest('.faq-item');
    const answer = parent.querySelector('.faq-answer');
    const icon = parent.querySelector('.faq-icon');

    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        answer.classList.add('hidden');
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}

function addStory(e) {
    e.preventDefault();
    const name = document.getElementById('story-name').value.trim();
    const style = document.getElementById('story-style').value.trim() || 'Mẫu Thiệp Mời';
    const content = document.getElementById('story-content').value.trim();

    if (name && content) {
        const list = document.getElementById('stories-list');
        const card = document.createElement('div');
        card.className = 'bg-white p-6 rounded-2xl border border-[#C5A880]/50 shadow-md space-y-3';
        card.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="font-serif font-bold text-[#2D2A26]">${escapeHtml(name)}</span>
                <span class="text-xs text-[#9A7B4F] uppercase font-semibold">${escapeHtml(style)}</span>
            </div>
            <p class="text-sm text-[#6E675F] italic">
                "${escapeHtml(content)}"
            </p>
        `;
        list.prepend(card);
        document.getElementById('story-form').reset();
        alert('Cảm ơn bạn đã chia sẻ câu chuyện trải nghiệm!');
    }
}

function escapeHtml(str) {
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
}
