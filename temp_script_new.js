    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // CKEditor initialization
        function initializeCKEditor(element) {
            ClassicEditor
                .create(element, {
                    language: 'fa',
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'bulletedList', 'numberedList', '|',
                        'insertTable', 'blockQuote', '|',
                        'undo', 'redo'
                    ]
                })
                .then(editor => {
                    element._ckeditor = editor;
                })
                .catch(error => {
                    console.error('خطا در بارگذاری CKEditor:', error);
                });
        }

        // Auto slug generation
        function generateSlug() {
            const titleInput = document.querySelector('[name="title[fa]"]');
            const slugInput = document.querySelector('[name="slug"]');

            if (titleInput && slugInput && titleInput.value.trim()) {
                fetch('{{ route("admin.articles.generate-slug") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ title: titleInput.value })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.slug) {
                        slugInput.value = data.slug;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Gallery Preview (no immediate upload)
        document.addEventListener('DOMContentLoaded', function() {
            const galleryInput = document.getElementById('gallery-images');

            if (galleryInput) {
                galleryInput.addEventListener('change', function(e) {
                    previewGalleryFiles(e.target.files);
                });
            }
        });

        function previewGalleryFiles(files) {
            const galleryPreview = document.getElementById('gallery-preview');
            galleryPreview.innerHTML = ''; // Clear previous previews

            if (files.length === 0) {
                galleryPreview.classList.add('hidden');
                return;
            }

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    // Check file size (2MB = 2,097,152 bytes)
                    if (file.size > 2097152) {
                        alert(`فایل "${file.name}" بیش از حد بزرگ است. حداکثر سایز مجاز 2MB می‌باشد.`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = createPreviewItem(e.target.result, file.name, index + 1);
                        galleryPreview.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });

            galleryPreview.classList.remove('hidden');
        }

        function createPreviewItem(imageSrc, fileName, sortOrder) {
            const div = document.createElement('div');
            div.className = 'relative bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden';

            div.innerHTML = `
                <div class="aspect-square">
                    <img src="${imageSrc}" alt="${fileName}" class="w-full h-full object-cover">
                </div>
                <div class="p-3">
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Alt Text</label>
                        <input type="text" name="gallery_alt_text[]" placeholder="توضیح تصویر"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Caption</label>
                        <input type="text" name="gallery_caption[]" placeholder="عنوان تصویر"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="mb-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">ترتیب</label>
                        <input type="number" name="gallery_sort_order[]" value="${sortOrder}" min="1"
                            class="w-full px-2 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                    </div>
                    <div class="text-xs text-green-600 font-medium">
                        ✓ آماده آپلود با مقاله
                    </div>
                </div>
            `;

            return div;
        }

        // Tab switching
        function switchTab(languageCode) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(tab => {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(`content-${languageCode}`).classList.remove('hidden');

            // Add active class to selected tab
            const activeTab = document.getElementById(`tab-${languageCode}`);
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-blue-500', 'text-blue-600');
        }
    </script>
</x-admin-layout>
