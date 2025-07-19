// Enhanced Date Picker
$("#tanggal_lahir").bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    maxDate: new Date(),
    format: "YYYY-MM-DD",
});

// Form Animation and Enhancement
document.addEventListener("DOMContentLoaded", function () {
    // Add loading animation to form submission
    const form = document.getElementById("employeeForm");
    const submitBtn = document.getElementById("submitBtn");

    form.addEventListener("submit", function (e) {
        submitBtn.classList.add("loading");
        submitBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });

    // Enhanced file input with drag & drop and preview
    const fileInput = document.getElementById("foto_profil");
    const fileDropZone = document.getElementById("fileDropZone");
    const imagePreviewContainer = document.getElementById(
        "imagePreviewContainer"
    );
    const imagePreview = document.getElementById("imagePreview");
    const fileInfo = document.getElementById("fileInfo");
    const removeFileBtn = document.getElementById("removeFileBtn");

    // Click to select file
    fileDropZone.addEventListener("click", () => {
        fileInput.click();
    });

    // Drag and drop functionality
    fileDropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        fileDropZone.classList.add("drag-over");
    });

    fileDropZone.addEventListener("dragleave", (e) => {
        e.preventDefault();
        fileDropZone.classList.remove("drag-over");
    });

    fileDropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        fileDropZone.classList.remove("drag-over");

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith("image/")) {
                handleFileSelect(file);
            } else {
                alert("Mohon pilih file gambar (JPG, PNG, GIF)");
            }
        }
    });

    // File input change event
    fileInput.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            handleFileSelect(file);
        }
    });

    // Remove file button
    removeFileBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        removeFile();
    });

    // Handle file selection and preview
    function handleFileSelect(file) {
        // Validate file size (2MB max)
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        if (file.size > maxSize) {
            alert("Ukuran file terlalu besar. Maksimal 2MB.");
            return;
        }

        // Validate file type
        const allowedTypes = [
            "image/jpeg",
            "image/jpg",
            "image/png",
            "image/gif",
        ];
        if (!allowedTypes.includes(file.type)) {
            alert("Format file tidak didukung. Gunakan JPG, PNG, atau GIF.");
            return;
        }

        // Create FileReader to read the file
        const reader = new FileReader();

        reader.onload = function (e) {
            // Show preview
            imagePreview.src = e.target.result;

            // Show file info
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            fileInfo.innerHTML = `
                        <i class="fas fa-file-image me-1"></i>
                        ${file.name} (${fileSize} MB)
                    `;

            // Hide drop zone, show preview
            fileDropZone.style.display = "none";
            imagePreviewContainer.style.display = "block";

            // Add animation
            imagePreviewContainer.style.opacity = "0";
            imagePreviewContainer.style.transform = "translateY(20px)";
            setTimeout(() => {
                imagePreviewContainer.style.transition = "all 0.3s ease";
                imagePreviewContainer.style.opacity = "1";
                imagePreviewContainer.style.transform = "translateY(0)";
            }, 10);
        };

        reader.readAsDataURL(file);
    }

    // Remove file function
    function removeFile() {
        // Clear the input
        fileInput.value = "";

        // Hide preview, show drop zone
        imagePreviewContainer.style.display = "none";
        fileDropZone.style.display = "block";

        // Clear preview and info
        imagePreview.src = "";
        fileInfo.innerHTML = "";

        // Add animation
        fileDropZone.style.opacity = "0";
        fileDropZone.style.transform = "translateY(-20px)";
        setTimeout(() => {
            fileDropZone.style.transition = "all 0.3s ease";
            fileDropZone.style.opacity = "1";
            fileDropZone.style.transform = "translateY(0)";
        }, 10);
    }

    // Phone number formatting
    const phoneInput = document.getElementById("nomor_telp");
    phoneInput.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\D/g, "");
        if (value.startsWith("0")) {
            value =
                "0" +
                value.substring(1).replace(/(\d{4})(\d{4})(\d{4})/, "$1$2$3");
        }
        e.target.value = value;
    });

    // Form validation enhancement
    const requiredFields = document.querySelectorAll(
        "input[required], select[required]"
    );
    requiredFields.forEach((field) => {
        field.addEventListener("blur", function () {
            if (this.value.trim() === "") {
                this.classList.add("is-invalid");
            } else {
                this.classList.remove("is-invalid");
                this.classList.add("is-valid");
            }
        });
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 5000);
    });
});

// Reset form with confirmation
document
    .querySelector('button[type="reset"]')
    .addEventListener("click", function (e) {
        e.preventDefault();
        if (confirm("Apakah Anda yakin ingin mengosongkan semua field?")) {
            document.getElementById("employeeForm").reset();
            // Remove all validation classes
            document
                .querySelectorAll(".is-valid, .is-invalid")
                .forEach((el) => {
                    el.classList.remove("is-valid", "is-invalid");
                });
            // Remove file preview and reset file input
            removeFile();
        }
    });
