import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const input = document.getElementById("dokumen");
const dropZone = document.getElementById("drop-zone");
const defView = document.getElementById("drop-default");
const preView = document.getElementById("drop-preview");
const fileName = document.getElementById("file-name");
const fileSize = document.getElementById("file-size");

function showPreview(file) {
    if (!file) return;
    fileName.textContent = file.name;
    fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + " MB";
    defView.classList.add("hidden");
    preView.classList.remove("hidden");
    preView.classList.add("flex");
}

input.addEventListener("change", () => showPreview(input.files[0]));

// Drag & drop
dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("border-indigo-400", "bg-indigo-50");
});
dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("border-green-400", "bg-green-50");
});
dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("border-red-400", "bg-red-50");
    const file = e.dataTransfer.files[0];
    if (file && file.type === "application/pdf") {
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        showPreview(file);
    }
});

let pendingAction = null;

function confirmAction(action) {
    pendingAction = action;
    const modal = document.getElementById("confirm-modal");
    const box = document.getElementById("modal-box");
    const icon = document.getElementById("modal-icon");
    const title = document.getElementById("modal-title");
    const desc = document.getElementById("modal-desc");
    const btn = document.getElementById("modal-confirm-btn");

    if (action === "accepted") {
        icon.className =
            "w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-green-100";
        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`;
        title.textContent = "Setujui Pengajuan?";
        desc.textContent = "Pengajuan ini akan ditandai sebagai Accepted.";
        btn.className =
            "px-5 py-2 rounded-lg text-sm font-bold text-white transition active:scale-95 bg-green-600 hover:bg-green-700";
    } else {
        icon.className =
            "w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 bg-red-100";
        icon.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>`;
        title.textContent = "Tolak Pengajuan?";
        desc.textContent = "Pengajuan ini akan ditandai sebagai Decline.";
        btn.className =
            "px-5 py-2 rounded-lg text-sm font-bold text-white transition active:scale-95 bg-red-500 hover:bg-red-600";
    }

    modal.classList.remove("hidden");
    modal.classList.add("flex");
    setTimeout(() => {
        box.classList.remove("scale-95", "opacity-0");
        box.classList.add("scale-100", "opacity-100");
    }, 10);
}

function closeModal() {
    const modal = document.getElementById("confirm-modal");
    const box = document.getElementById("modal-box");
    box.classList.remove("scale-100", "opacity-100");
    box.classList.add("scale-95", "opacity-0");
    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        pendingAction = null;
    }, 200);
}

document
    .getElementById("modal-confirm-btn")
    .addEventListener("click", function () {
        if (!pendingAction) return;
        // TODO: submit form / axios ke route update status
        // Contoh: window.location.href = `/urugan-tanah/{{ $urugan->id }}/status/${pendingAction}`;
        alert("Action: " + pendingAction + " (logic belum diimplementasi)");
        closeModal();
    });

// Tutup modal klik backdrop
document
    .getElementById("confirm-modal")
    .addEventListener("click", function (e) {
        if (e.target === this) closeModal();
    });
