// tk.js - Live Synchronization & Export Logic
function syncPreview() {
    const groom = document.getElementById('in-groom').value || 'Vũ Hoàng Nam';
    const bride = document.getElementById('in-bride').value || 'Trần Mai Linh';
    const groomParents = document.getElementById('in-groom-parents').value;
    const brideParents = document.getElementById('in-bride-parents').value;
    const dateVal = document.getElementById('in-date').value || '2025-11-28';
    const timeVal = document.getElementById('in-time').value || '17:30';
    const lunar = document.getElementById('in-lunar').value;
    const venueName = document.getElementById('in-venue-name').value;
    const venueAddress = document.getElementById('in-venue-address').value;
    const quote = document.getElementById('in-quote').value;

    document.getElementById('card-couple-name').textContent = groom + ' & ' + bride;
    document.getElementById('card-parents-groom').textContent = groomParents;
    document.getElementById('card-parents-bride').textContent = brideParents;

    const parts = dateVal.split('-');
    if (parts.length === 3) {
        document.getElementById('card-time-date').textContent = timeVal + ' • Thứ Bảy, ' + parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    
    document.getElementById('card-lunar').textContent = lunar;
    document.getElementById('card-venue-name').textContent = venueName;
    document.getElementById('card-venue-address').textContent = venueAddress;
    document.getElementById('card-quote').textContent = quote;
}

function changeStyle(styleKey) {
    const container = document.getElementById('preview-container');
    container.className = 'w-full p-6 sm:p-10 rounded-2xl border-4 shadow-2xl transition-all duration-300 ';
    
    if (styleKey === 'royal') {
        container.classList.add('preview-royal');
    } else if (styleKey === 'minimal') {
        container.classList.add('preview-minimal');
    } else if (styleKey === 'botanical') {
        container.classList.add('preview-botanical');
    } else if (styleKey === 'nocturne') {
        container.classList.add('preview-nocturne');
    }
}

function selectPresetImage(src) {
    document.getElementById('card-photo').src = src;
}

function uploadUserPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('card-photo').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function copyShareLink() {
    const input = document.getElementById('share-link-input');
    input.select();
    navigator.clipboard.writeText(input.value);
    alert('Đã sao chép đường link website thiệp riêng thành công!');
}

function openStandaloneWebInvitation() {
    const cardContent = document.getElementById('live-card').outerHTML;
    const containerStyle = document.getElementById('preview-container').className;
    
    const modalContent = document.getElementById('standalone-content');
    modalContent.innerHTML = `
        <div class="${containerStyle} rounded-xl p-8 shadow-inner">
            ${cardContent}
        </div>
    `;
    document.getElementById('standalone-modal').classList.remove('hidden');
}

function closeStandaloneModal() {
    document.getElementById('standalone-modal').classList.add('hidden');
}

// Export PDF using html2canvas & jsPDF
function exportPDF() {
    const element = document.getElementById('preview-container');
    alert('Đang tạo tệp PDF in ấn chuẩn 300 DPI, vui lòng chờ trong giây lát...');

    html2canvas(element, { scale: 2, useCORS: true }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');
        const imgWidth = 190;
        const pageHeight = 295;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        
        pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
        pdf.save('ThiepMoi_ThietKe_300DPI.pdf');
    }).catch(err => {
        alert('Lỗi xuất file PDF. Đang dùng lệnh in mặc định...');
        window.print();
    });
}

// Export PNG HD
function exportPNG() {
    const element = document.getElementById('preview-container');
    alert('Đang tạo tệp ảnh PNG sắc nét HD, vui lòng chờ...');

    html2canvas(element, { scale: 3, useCORS: true }).then(canvas => {
        const link = document.createElement('a');
        link.download = 'ThiepMoi_HD_SacNet.png';
        link.href = canvas.toDataURL('image/png');
        link.click();
    }).catch(err => {
        alert('Có lỗi khi tạo ảnh PNG.');
    });
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    syncPreview();
});
